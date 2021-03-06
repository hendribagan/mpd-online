<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_rep_bppsSearch" returnPage="t_rep_lap_bpps_piutang2.ccp" PathID="t_rep_bppsSearch" pasteActions="pasteActions">
			<Components>
				<TextBox id="559" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="tgl_penerimaan" PathID="t_rep_bppsSearchtgl_penerimaan" format="dd-mm-yyyy" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="560" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="year_code" PathID="t_rep_bppsSearchyear_code" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="561" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="vat_code" PathID="t_rep_bppsSearchvat_code" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="562" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_rep_bppsSearchp_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="563" fieldSourceType="DBColumn" dataType="Text" name="p_year_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_rep_bppsSearchp_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" PathID="t_rep_bppsSearchButton_DoSearch">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="564" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="ListBox1" wizardEmptyCaption="Select Value" PathID="t_rep_bppsSearchListBox1" connection="ConnSIKP" _valueOfList="2" _nameOfList="Denda" dataSource="1;Pokok;2;Denda" fieldSource="i_flag_setoran" required="True">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="568" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<DatePicker id="191" name="DatePicker_tgl_penerimaan" control="tgl_penerimaan" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="t_rep_bppsSearchDatePicker_tgl_penerimaan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="565" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="tgl_penerimaan_last" PathID="t_rep_bppsSearchtgl_penerimaan_last" format="dd-mm-yyyy" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="566" name="DatePicker_tgl_penerimaan_last1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_rep_bppsSearchDatePicker_tgl_penerimaan_last1" control="tgl_penerimaan_last" wizardDatePickerType="Image" wizardPicture="../Styles/None/Images/DatePicker.gif" style="../Styles/sikp/Style.css">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<ListBox id="567" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="jenis_laporan" wizardEmptyCaption="Select Value" PathID="t_rep_bppsSearchjenis_laporan" connection="ConnSIKP" _valueOfList="piutang" _nameOfList="NON MURNI" dataSource="all;SEMUA;piutang;NON MURNI;murni;MURNI" required="True">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<Button id="569" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoPrint" PathID="t_rep_bppsSearchButton_DoPrint">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="570" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch1" PathID="t_rep_bppsSearchButton_DoSearch1">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="571" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch2" PathID="t_rep_bppsSearchButton_DoSearch2">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="True" name="Label1" PathID="Label1">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_rep_lap_bpps_piutang2_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_rep_lap_bpps_piutang2.php" forShow="True" url="t_rep_lap_bpps_piutang2.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="66"/>
			</Actions>
		</Event>
	</Events>
</Page>
