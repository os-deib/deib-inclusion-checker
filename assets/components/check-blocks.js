import { useEffect, useState } from '@wordpress/element';
import { useSelect } from '@wordpress/data';
import { useDebounce } from '@wordpress/compose';
import { __ } from '@wordpress/i18n';

import apiFetch from '@wordpress/api-fetch';
import IssueSummary from '../components/issue-summary';

const CheckBlocks = ( props ) => {
	const foundWordIssues = document.querySelector( '#found-word-issues' );

	const blocks = useSelect( ( select ) => select( 'core/block-editor' ).getBlocks() );

	const [ blocksState, setBlocksState ] = useState( null );
	const [ wordCheckerIssues, setWordCheckerIssues ] = useState( null );

	useEffect( () => {
		updateBlocksWithDebounce( blocks );
	}, [ blocks ] );

	const updateBlocksWithDebounce = useDebounce( ( blocks ) => {
		setBlocksState( blocks );
		checkBlocks( blocks );
	}, 500 );

	const checkBlocks = () => {
		apiFetch( {
			data: { blocks },
			method: 'POST',
			path: '/deibci/v1/parseblocks',
		} ).then( ( res ) => {
			setWordCheckerIssues( res );
		} );
	};
	return (
		<>
			{
				wordCheckerIssues ?
					<div>
						{ wordCheckerIssues.map( wordIssue => {
							return <IssueSummary
								phrase={ wordIssue.item.phrase }
								alternative={ wordIssue.item.alternative }
								explanation={ wordIssue.item.explanation }
							/>
						} ) }
					</div>
					:
					<span>{ __( "No issues found", "deib-inclusion-checker" ) }</span>
			}
		</>
	);
};

export default CheckBlocks;
