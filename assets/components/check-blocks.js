import { useEffect, useState } from '@wordpress/element';
import { useSelect } from '@wordpress/data';
import { useDebounce } from '@wordpress/compose';

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
		console.log( 'blocksChanged' );
		console.log( blocks );
		setBlocksState( blocks );
		checkBlocks( blocks );
	}, 500 );

	const checkBlocks = ( apiKeyValue ) => {
		/*
		apiFetch( {
			data: { cabfm_api_key: apiKeyValue },
			method: 'POST',
			path: '/wp/v2/settings',
		} ).then( ( res ) => {
			setBlocksState( res );
		} );
		*/
		setWordCheckerIssues(
			[
				{
					"label": "First word",
					"alternative": "Another first word, ano one more",
					"explanation": "Some explanation for the word ...",
				},
				{
					"label": "Second word",
					"alternative": "Another second word, ano one more",
					"explanation": "Some explanation for the word ...",
				},
				{
					"label": "Third word",
					"alternative": "Another third word, ano one more",
					"explanation": "Some explanation for the word ...",
				}
			]
		);

	};
	return (
		<>
			{ wordCheckerIssues && <div>
				{ wordCheckerIssues.map( wordIssue =>
					<IssueSummary
						label={ wordIssue.label }
						alternative={ wordIssue.alternative }
						explanation={ wordIssue.explanation }
					/>
				) }
			</div> }
		</>
	);
};

export default CheckBlocks;
