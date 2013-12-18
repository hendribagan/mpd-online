<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\lov" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" validateRequest="True" cachingDuration="1 minutes" wizardTheme="sikm" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="ConnSIKP" name="LovGrid" pageSizeLimit="100" wizardCaption="List of P CUSTOMER SEGMENT " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" pasteActions="pasteActions" activeCollection="SQLParameters" dataSource="SELECT a.p_app_user_id, a.app_user_name, a.user_pwd, a.p_user_status_id, b.code 
FROM p_app_user a INNER JOIN p_user_status b ON
a.p_user_status_id = b.p_user_status_id 
WHERE upper(a.app_user_name) like '%{s_keyword}%'
OR upper(b.code) like '%{s_keyword}%'
ORDER BY a.p_app_user_id" parameterTypeListName="ParameterTypeList" resultSetType="parameter" orderBy="p_app_user_id">
			<Components>
				<Label id="14" fieldSourceType="DBColumn" dataType="Text" html="False" name="app_user_name" fieldSource="app_user_name" wizardCaption="CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="LovGridapp_user_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="25" fieldSourceType="DBColumn" dataType="Text" html="True" name="PILIH" PathID="LovGridPILIH">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="26"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="64" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" fieldSource="code" wizardCaption="CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="LovGridcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Hidden id="73" fieldSourceType="DBColumn" dataType="Text" name="user_pwd" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="LovGriduser_pwd" fieldSource="user_pwd">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<Hidden id="74" fieldSourceType="DBColumn" dataType="Float" name="p_user_status_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="LovGridp_user_status_id" fieldSource="p_user_status_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<Hidden id="75" fieldSourceType="DBColumn" dataType="Float" name="p_app_user_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="LovGridp_app_user_id" fieldSource="p_app_user_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="47"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="50"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="62"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
				<JoinTable id="63" tableName="p_app_user" posLeft="10" posTop="10" posWidth="133" posHeight="180" alias="a"/>
<JoinTable id="65" tableName="p_user_status" alias="b" posLeft="164" posTop="10" posWidth="144" posHeight="180"/>
</JoinTables>
			<JoinLinks>
<JoinTable2 id="66" tableLeft="a" tableRight="b" fieldLeft="a.p_user_status_id" fieldRight="b.p_user_status_id" joinType="inner" conditionType="Equal"/>
</JoinLinks>
			<Fields>
<Field id="67" tableName="a" fieldName="app_user_name"/>
<Field id="69" tableName="a" fieldName="user_pwd"/>
<Field id="70" tableName="a" fieldName="a.p_user_status_id" alias="a_p_user_status_id"/>
<Field id="71" tableName="b" fieldName="code"/>
</Fields>
			<SPParameters>
				<SPParameter id="52" parameterName="i_search_key" parameterSource="i_search_key" parameterType="URL" direction="Input" dataType="Char" dataSize="255" scale="0" precision="0"/>
			</SPParameters>
			<SQLParameters>
				<SQLParameter id="72" variable="s_keyword" parameterType="URL" dataType="Text" parameterSource="s_keyword"/>
</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="LOV" returnPage="lov_cust_user.ccp" PathID="LOV" connection="ConnSIKP">
			<Components>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" PathID="LOVs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" PathID="LOVButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="24" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="FORM" PathID="LOVFORM">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="30" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="OBJ" PathID="LOVOBJ">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
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
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="lov_cust_user_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="lov_cust_user.php" forShow="True" url="lov_cust_user.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
