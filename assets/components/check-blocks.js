import { useEffect, useState } from '@wordpress/element';
import { Spinner } from '@wordpress/components';
import { useDebounce } from '@wordpress/compose';
import { useSelect } from '@wordpress/data';
import { __ } from '@wordpress/i18n';

import apiFetch from '@wordpress/api-fetch';
import IssueSummary from '../components/issue-summary';

const CheckBlocks = () => {
	const blocks = useSelect( ( select ) => select( 'core/block-editor' ).getBlocks() );

	const [ wordCheckerIssues, setWordCheckerIssues ] = useState( null );
	const [ isLoading, setIsLoading ] = useState( false );

	useEffect( () => {
		if (!wordCheckerIssues) {
			checkBlocks( blocks );
		} else {
			updateBlocksWithDebounce( blocks );
		}
	}, [ blocks ] );

	const updateBlocksWithDebounce = useDebounce( ( blocks ) => {
		checkBlocks( blocks );
	}, 500 );

	const checkBlocks = () => {
		setIsLoading( true );

		apiFetch( {
			data: { blocks },
			method: 'POST',
			path: '/deibic/v1/parseblocks',
		} ).then( ( res ) => {
			setWordCheckerIssues( res );
			setIsLoading( false );
		} );
	};

	return (
		<>
			{
				wordCheckerIssues ?
					<div>
						{ wordCheckerIssues.map( wordIssue => {
							return <IssueSummary item={ wordIssue.item }/>
						} ) }
					</div>
					:
					<span>{ __( "No issues found", "deib-inclusion-checker" ) }</span>
			}
			{
				isLoading && <div>
					<Spinner/> { __( "Analyzing ...", "deib-inclusion-checker" ) }
				</div>
			}
		</>
	);
};

export default CheckBlocks;
