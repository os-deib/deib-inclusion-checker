import { __ } from '@wordpress/i18n';

import CheckBlocks from '../components/check-blocks';

const WordCheckSummary = () => (
	<div className="deib-ic-word-check-summary">
		<p>
			{ __( "Your text is using some words or phrases, that should be removed or replaced to be more inclusive.", "deib-inclusion-checker" ) }
		</p>
		<CheckBlocks/>
	</div>
);

export default WordCheckSummary;
