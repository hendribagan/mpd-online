<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_setllementGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" dataSource="SELECT x.* 
FROM v_t_cust_acc_status_modif x
where p_order_status_id =2
and (x.wp_name ILIKE '%{s_keyword}%' OR x.npwd ILIKE '%{s_keyword}%')
order by x.updated_date desc">
			<Components>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="t_penutupan_wp_master.ccp" wizardThemeItem="GridA" PathID="t_vat_setllementGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="314" sourceType="DataField" name="t_cust_acc_status_modif_id" source="t_cust_acc_status_modif_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="status_request_date" fieldSource="status_request_date" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridstatus_request_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" name="p_account_status_mut" fieldSource="p_account_status_mut" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridp_account_status_mut" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="reason_code" fieldSource="reason_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridreason_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cust_acc_status_modif_id" fieldSource="t_cust_acc_status_modif_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_setllementGridt_cust_acc_status_modif_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="244" fieldSourceType="DBColumn" dataType="Text" html="False" name="wp_name" fieldSource="wp_name" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridwp_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="399" fieldSourceType="DBColumn" dataType="Text" html="False" name="npwd" fieldSource="npwd" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridnpwd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="400" fieldSourceType="DBColumn" dataType="Text" html="False" name="order_no" fieldSource="order_no" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridorder_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="226"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="315" styles="Row;AltRow" name="rowStyle"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="261" conditionType="Parameter" useIsNull="False" field="p_order_status_id" dataType="Float" searchConditionType="Equal" parameterType="Expression" logicOperator="And" leftBrackets="0" parameterSource="1"/>
				<TableParameter id="312" conditionType="Parameter" useIsNull="False" field="upper(npwd)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_keyword" leftBrackets="1"/>
				<TableParameter id="313" conditionType="Parameter" useIsNull="False" field="upper(finance_period_code)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_keyword" rightBrackets="1"/>
				<TableParameter id="373" conditionType="Parameter" useIsNull="False" field="p_settlement_type_id" dataType="Float" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="2"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="247" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="384" parameterType="Expression" variable="Expr0" dataType="Float" parameterSource="1"/>
				<SQLParameter id="385" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword"/>
				<SQLParameter id="386" parameterType="Expression" variable="Expr1" dataType="Float" parameterSource="2"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="23" sourceType="SQL" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_vat_setllementForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="t_vat_setllementForm" activeCollection="ISQLParameters" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" dataSource="SELECT x.* 
FROM v_t_cust_acc_status_modif x
WHERE t_cust_acc_status_modif_id = {t_cust_acc_status_modif_id} " customUpdateType="SQL" customDeleteType="SQL" customDelete="select o_result_code, o_result_msg from f_first_submit_engine(507,{t_customer_order_id},'{UserName}')" customUpdate="UPDATE t_cust_acc_status_modif
SET 
p_account_status_id = {p_account_status_id},
reason_status_id = {reason_status_id},
updated_date = sysdate,
updated_by = '{user}',
reason_description = '{reason_description}'
where 
t_cust_acc_status_modif_id = {t_cust_acc_status_modif_id}" customInsertType="SQL" customInsert="select f_del_mutasi_status_wp(
{t_cust_acc_sts_modif_id}, 
'{user}') 
from dual">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" wizardCaption="Add" PathID="t_vat_setllementFormButton_Insert" removeParameters="FLAG" operation="Insert">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="411"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_vat_setllementFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="412"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="t_vat_setllementFormButton_Delete" removeParameters="FLAG;t_vat_setllement_id">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="27" message="Submit record?" eventType="Client"/>
								<Action actionName="Custom Code" actionCategory="General" id="383"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="order_no" fieldSource="order_no" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormorder_no" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="reason_description" fieldSource="reason_description" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormreason_description" required="False" caption="keterangan alasan penutupan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="243" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="npwd" fieldSource="npwd" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormnpwd" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="279" fieldSourceType="DBColumn" dataType="Float" name="t_cust_account_id" PathID="t_vat_setllementFormt_cust_account_id" fieldSource="t_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="263" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_id" PathID="t_vat_setllementFormp_vat_type_id" fieldSource="p_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="283" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_name" fieldSource="wp_name" caption="Nama Wajib Pajak" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormwp_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="374" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" PathID="t_vat_setllementFormButton1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="379" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Hapus" wizardCaption="Submit" PathID="t_vat_setllementFormButton_Hapus" removeParameters="t_cust_acc_status_modif_id">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="409"/>
							</Actions>
						</Event>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="410"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="388" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="reason_code" fieldSource="reason_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormreason_code" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="390" fieldSourceType="DBColumn" dataType="Float" name="reason_status_id" PathID="t_vat_setllementFormreason_status_id" fieldSource="reason_status_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="381" urlType="Relative" enableValidation="True" isDefault="False" name="view" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementFormview">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="30" fieldSourceType="DBColumn" dataType="Float" name="t_cust_acc_status_modif_id" fieldSource="t_cust_acc_status_modif_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormt_cust_acc_status_modif_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="391" fieldSourceType="DBColumn" dataType="Float" name="t_customer_order_id" PathID="t_vat_setllementFormt_customer_order_id" fieldSource="t_customer_order_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="394" fieldSourceType="DBColumn" dataType="Float" name="p_account_status_id" fieldSource="p_account_status_id" PathID="t_vat_setllementFormp_account_status_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextArea id="284" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_name" fieldSource="wp_address_name" caption="Alamat Wajib Pajak" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormwp_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextBox id="395" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="company_brand" fieldSource="company_brand" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormcompany_brand" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="396" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_code" fieldSource="p_vat_type_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormp_vat_type_code" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="397" fieldSourceType="DBColumn" dataType="Float" name="t_customer_id" PathID="t_vat_setllementFormt_customer_id" fieldSource="t_customer_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="398" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="p_account_status_mut" fieldSource="p_account_status_mut" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormp_account_status_mut" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="406" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events>
			</Events>
			<TableParameters>
				<TableParameter id="250" conditionType="Parameter" useIsNull="False" field="t_vat_setllement_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_vat_setllement_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="387" parameterType="URL" variable="t_cust_acc_status_modif_id" dataType="Float" parameterSource="t_cust_acc_status_modif_id" defaultValue="0"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="407" variable="t_cust_acc_sts_modif_id" parameterType="Control" defaultValue="0" dataType="Integer" parameterSource="t_cust_acc_sts_modif_id"/>
				<SQLParameter id="408" variable="user" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="316" field="finance_period_code" dataType="Text" parameterType="Control" parameterSource="finance_period_code"/>
				<CustomParameter id="317" field="order_no" dataType="Text" parameterType="Control" parameterSource="order_no"/>
				<CustomParameter id="318" field="total_trans_amount" dataType="Float" parameterType="Control" parameterSource="total_trans_amount" format="#,##0.00"/>
				<CustomParameter id="319" field="total_vat_amount" dataType="Float" parameterType="Control" parameterSource="total_vat_amount" format="#,##0.00"/>
				<CustomParameter id="320" field="npwd" dataType="Text" parameterType="Control" parameterSource="npwd"/>
				<CustomParameter id="321" field="t_vat_setllement_id" dataType="Float" parameterType="Control" parameterSource="t_vat_setllement_id"/>
				<CustomParameter id="322" field="t_cust_account_id" dataType="Float" parameterType="Control" parameterSource="t_cust_account_id"/>
				<CustomParameter id="323" field="p_vat_type_id" dataType="Text" parameterType="Control" parameterSource="p_vat_type_id"/>
				<CustomParameter id="324" field="p_rqst_type_id" dataType="Float" parameterType="Control" parameterSource="p_rqst_type_id"/>
				<CustomParameter id="325" field="year_code" dataType="Text" parameterType="Control" parameterSource="year_code"/>
				<CustomParameter id="326" field="p_year_period_id" dataType="Float" parameterType="Control" parameterSource="p_year_period_id"/>
				<CustomParameter id="327" field="jenis_pajak" dataType="Text" parameterType="Control" parameterSource="jenis_pajak"/>
				<CustomParameter id="328" field="wp_name" dataType="Text" parameterType="Control" parameterSource="wp_name"/>
				<CustomParameter id="329" field="wp_address_name" dataType="Text" parameterType="Control" parameterSource="wp_address_name"/>
				<CustomParameter id="330" field="start_period" dataType="Text" parameterType="Control" parameterSource="start_period" format="dd-mmm-yyyy"/>
				<CustomParameter id="331" field="end_period" dataType="Text" parameterType="Control" parameterSource="end_period" format="dd-mmm-yyyy"/>
				<CustomParameter id="332" field="due_date" dataType="Text" parameterType="Control" parameterSource="due_date" format="dd-mmm-yyyy H:nn:ss"/>
				<CustomParameter id="333" field="debt_vat_amt" dataType="Float" parameterType="Control" parameterSource="debt_vat_amt" format="#,##0.00"/>
				<CustomParameter id="334" field="cr_adjustment" dataType="Float" parameterType="Control" parameterSource="cr_adjustment" format="#,##0.00"/>
				<CustomParameter id="335" field="cr_others" dataType="Float" parameterType="Control" parameterSource="cr_others" format="#,##0.00"/>
				<CustomParameter id="336" field="cr_payment" dataType="Float" parameterType="Control" parameterSource="cr_payment" format="#,##0.00"/>
				<CustomParameter id="337" field="cr_stp" dataType="Float" parameterType="Control" parameterSource="cr_stp" format="#,##0.00"/>
				<CustomParameter id="338" field="db_interest_charge" dataType="Float" parameterType="Control" parameterSource="db_interest_charge" format="#,##0.00"/>
				<CustomParameter id="339" field="db_increasing_charge" dataType="Float" parameterType="Control" parameterSource="db_increasing_charge" format="#,##0.00"/>
				<CustomParameter id="340" field="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id"/>
				<CustomParameter id="341" field="p_finance_period_id" dataType="Float" parameterType="Control" parameterSource="p_finance_period_id"/>
			</IFormElements>
			<USPParameters>
				<SPParameter id="Key374" dataType="Char" parameterType="URL" dataSize="255" direction="ReturnValue" scale="0" precision="0" parameterName="o_result_msg" parameterSource="o_result_msg"/>
				<SPParameter id="Key375" parameterName="i_finance_period_id" parameterSource="p_finance_period_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key376" parameterName="i_start_period" parameterSource="start_period" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key377" parameterName="i_end_period" parameterSource="end_period" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key378" parameterName="i_total_trans_amount" parameterSource="total_trans_amount" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key379" parameterName="i_total_vat_amount" parameterSource="total_vat_amount" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key380" parameterName="i_total_penalty_amount" parameterSource="total_penalty_amount" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key381" parameterName="i_due_date" parameterSource="due_date" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key382" parameterName="i_debt_vat_amt" parameterSource="debt_vat_amt" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key383" parameterName="i_cr_adjustment" parameterSource="cr_adjustment" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key384" parameterName="i_cr_payment" parameterSource="cr_payment" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key385" parameterName="i_cr_others" parameterSource="cr_others" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key386" parameterName="i_cr_stp" parameterSource="cr_stp" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key387" parameterName="i_db_interest_charge" parameterSource="db_interest_charge" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key388" parameterName="i_db_increasing_charge" parameterSource="db_increasing_charge" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key389" parameterName="i_vat_setllement_id" parameterSource="t_vat_setllement_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key390" parameterName="i_user" parameterSource="CCGetUserLogin()" dataType="Char" parameterType="Expression" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key391" parameterName="i_status" parameterSource="'1'" dataType="Char" parameterType="Expression" dataSize="255" direction="Input" scale="10" precision="6"/>
			</USPParameters>
			<USQLParameters>
				<SQLParameter id="401" variable="p_account_status_id" parameterType="Control" defaultValue="0" dataType="Integer" parameterSource="p_account_status_id"/>
				<SQLParameter id="402" variable="reason_status_id" parameterType="Control" defaultValue="0" dataType="Integer" parameterSource="reason_status_id"/>
				<SQLParameter id="403" variable="user" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="404" variable="reason_description" parameterType="Control" dataType="Text" parameterSource="reason_description"/>
				<SQLParameter id="405" variable="t_cust_acc_status_modif_id" parameterType="Control" defaultValue="0" dataType="Integer" parameterSource="t_cust_acc_status_modif_id"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="346" field="finance_period_code" dataType="Text" parameterType="Control" parameterSource="finance_period_code"/>
				<CustomParameter id="347" field="order_no" dataType="Text" parameterType="Control" parameterSource="order_no"/>
				<CustomParameter id="348" field="total_trans_amount" dataType="Float" parameterType="Control" parameterSource="total_trans_amount" format="#,##0.00"/>
				<CustomParameter id="349" field="total_vat_amount" dataType="Float" parameterType="Control" parameterSource="total_vat_amount" format="#,##0.00"/>
				<CustomParameter id="350" field="npwd" dataType="Text" parameterType="Control" parameterSource="npwd"/>
				<CustomParameter id="351" field="t_vat_setllement_id" dataType="Float" parameterType="Control" parameterSource="t_vat_setllement_id"/>
				<CustomParameter id="352" field="t_cust_account_id" dataType="Float" parameterType="Control" parameterSource="t_cust_account_id"/>
				<CustomParameter id="353" field="p_vat_type_id" dataType="Text" parameterType="Control" parameterSource="p_vat_type_id"/>
				<CustomParameter id="354" field="p_rqst_type_id" dataType="Float" parameterType="Control" parameterSource="p_rqst_type_id"/>
				<CustomParameter id="355" field="year_code" dataType="Text" parameterType="Control" parameterSource="year_code"/>
				<CustomParameter id="356" field="p_year_period_id" dataType="Float" parameterType="Control" parameterSource="p_year_period_id"/>
				<CustomParameter id="357" field="jenis_pajak" dataType="Text" parameterType="Control" parameterSource="jenis_pajak"/>
				<CustomParameter id="358" field="wp_name" dataType="Text" parameterType="Control" parameterSource="wp_name"/>
				<CustomParameter id="359" field="wp_address_name" dataType="Text" parameterType="Control" parameterSource="wp_address_name"/>
				<CustomParameter id="360" field="start_period" dataType="Text" parameterType="Control" parameterSource="start_period" format="dd-mmm-yyyy"/>
				<CustomParameter id="361" field="end_period" dataType="Text" parameterType="Control" parameterSource="end_period" format="dd-mmm-yyyy"/>
				<CustomParameter id="362" field="due_date" dataType="Text" parameterType="Control" parameterSource="due_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="363" field="debt_vat_amt" dataType="Float" parameterType="Control" parameterSource="debt_vat_amt" format="#,##0.00"/>
				<CustomParameter id="364" field="cr_adjustment" dataType="Float" parameterType="Control" parameterSource="cr_adjustment" format="#,##0.00"/>
				<CustomParameter id="365" field="cr_others" dataType="Float" parameterType="Control" parameterSource="cr_others" format="#,##0.00"/>
				<CustomParameter id="366" field="cr_payment" dataType="Float" parameterType="Control" parameterSource="cr_payment" format="#,##0.00"/>
				<CustomParameter id="367" field="cr_stp" dataType="Float" parameterType="Control" parameterSource="cr_stp" format="#,##0.00"/>
				<CustomParameter id="368" field="db_interest_charge" dataType="Float" parameterType="Control" parameterSource="db_interest_charge" format="#,##0.00"/>
				<CustomParameter id="369" field="db_increasing_charge" dataType="Float" parameterType="Control" parameterSource="db_increasing_charge" format="#,##0.00"/>
				<CustomParameter id="370" field="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id"/>
				<CustomParameter id="371" field="p_finance_period_id" dataType="Float" parameterType="Control" parameterSource="p_finance_period_id"/>
				<CustomParameter id="372" field="total_penalty_amount" dataType="Float" parameterType="Control" parameterSource="total_penalty_amount" format="#,##0.00"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="342" variable="t_customer_order_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_customer_order_id"/>
				<SQLParameter id="343" variable="UserName" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_vat_setllementSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_penutupan_wp_master.ccp" PathID="t_vat_setllementSearch" pasteActions="pasteActions">
			<Components>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_vat_setllementSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="t_vat_setllementSearchButton_DoSearch">
					<Components/>
					<Events/>
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
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_penutupan_wp_master_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_penutupan_wp_master.php" forShow="True" url="t_penutupan_wp_master.php" comment="//" codePage="windows-1252"/>
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
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="260"/>
			</Actions>
		</Event>
	</Events>
</Page>
