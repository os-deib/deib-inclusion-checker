import { Icon } from '@wordpress/components';
import { info, plusCircle, help } from '@wordpress/icons';
import { __ } from '@wordpress/i18n';

const IssueSummary = ( { phrase, explanation, alternative } ) => {
	return <details>
		<summary>
			<div className="issue-row">
				<Icon icon={ info } className="icon issue"/>
				{ phrase }
				<span className="toggle">{ __( "Why?", "deib-inclusion-checker" ) }</span>
			</div>
			<div className="alternative-row">
				<Icon icon={ plusCircle } className="icon alternative"/>
				{ alternative }
			</div>
		</summary>
		<div className="explanation">
			<Icon icon={ help } className="icon explanation"/>
			{ explanation ?? __( "(word/phrase is missing an explanation)", "deib-inclusion-checker" ) }
		</div>
	</details>;
}

export default IssueSummary;
