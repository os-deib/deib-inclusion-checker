import { PluginDocumentSettingPanel, PluginPrePublishPanel } from '@wordpress/edit-post';
import { registerPlugin } from '@wordpress/plugins';

import WordCheckSummary from "../components/word-check-summary";

registerPlugin(
	'inclusive-checker',
	{
		render() {
			return <>
				<PluginDocumentSettingPanel
					title="Inclusion Checker"
					initialOpen="true"
				>
					<WordCheckSummary/>
				</PluginDocumentSettingPanel>
				<PluginPrePublishPanel
					title="Inclusion Checker"
					initialOpen="true"
					icon="false"
				>
					<WordCheckSummary/>
				</PluginPrePublishPanel>
			</>
		}
	}
);
