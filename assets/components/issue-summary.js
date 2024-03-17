import { Icon } from '@wordpress/components';
import { info, plusCircle, help } from '@wordpress/icons';
import { __ } from '@wordpress/i18n';

const IssueSummary = ( { label, explanation, alternative } ) => {
	return <details>
		<summary>
			<div className="issue-row">
				<Icon icon={ info } className="icon issue"/>
				{ label }
				<span className="toggle">{ __( "Why?", "deib-inclusion-checker" ) }</span>
			</div>
			<div className="alternative-row">
				<Icon icon={ plusCircle } className="icon alternative"/>
				{ alternative }
			</div>
		</summary>
		<div className="explanation">
			<Icon icon={ help } className="icon explanation"/>
			{ explanation ?? '(word/phrase is missing an explanation)' }
		</div>
	</details>;
}

export default IssueSummary;
