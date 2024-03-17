import { Icon } from '@wordpress/components';
import { info, plusCircle, help } from '@wordpress/icons';
import { __ } from '@wordpress/i18n';

const IssueSummary = ( { item } ) => {
	return <details>
		<summary>
			<div className="issue-row">
				<Icon icon={ info } className="icon issue"/>
				{ item.phrase }
				<span className="toggle">{ __( "Why?", "deib-inclusion-checker" ) }</span>
			</div>
			<div className="alternatives-row">
				<Icon icon={ plusCircle } className="icon alternatives"/>
				{ item.alternatives.length ? item.alternatives.join( ', ' ) : `(${ item.suggested_action })` }
			</div>
		</summary>
		<div className="explanation">
			<Icon icon={ help } className="icon explanation"/>
			{ item.explanation ?? __( "(word/phrase is missing an explanation)", "deib-inclusion-checker" ) }
		</div>
	</details>;
}

export default IssueSummary;
