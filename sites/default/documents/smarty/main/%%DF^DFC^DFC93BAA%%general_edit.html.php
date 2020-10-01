<?php /* Smarty version 2.6.31, created on 2020-09-30 23:53:32
         compiled from /var/www/openemr.soepaing.com/templates/prescription/general_edit.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'headerTemplate', '/var/www/openemr.soepaing.com/templates/prescription/general_edit.html', 14, false),array('function', 'xlt', '/var/www/openemr.soepaing.com/templates/prescription/general_edit.html', 105, false),array('function', 'xla', '/var/www/openemr.soepaing.com/templates/prescription/general_edit.html', 110, false),array('function', 'amcCollect', '/var/www/openemr.soepaing.com/templates/prescription/general_edit.html', 125, false),array('function', 'html_options', '/var/www/openemr.soepaing.com/templates/prescription/general_edit.html', 169, false),array('function', 'html_radios', '/var/www/openemr.soepaing.com/templates/prescription/general_edit.html', 256, false),array('function', 'xlj', '/var/www/openemr.soepaing.com/templates/prescription/general_edit.html', 351, false),array('function', 'datetimepickerSupport', '/var/www/openemr.soepaing.com/templates/prescription/general_edit.html', 371, false),array('modifier', 'js_url', '/var/www/openemr.soepaing.com/templates/prescription/general_edit.html', 83, false),array('modifier', 'attr', '/var/www/openemr.soepaing.com/templates/prescription/general_edit.html', 111, false),array('modifier', 'text', '/var/www/openemr.soepaing.com/templates/prescription/general_edit.html', 112, false),array('modifier', 'attr_url', '/var/www/openemr.soepaing.com/templates/prescription/general_edit.html', 118, false),array('modifier', 'oeFormatShortDate', '/var/www/openemr.soepaing.com/templates/prescription/general_edit.html', 163, false),)), $this); ?>
<!DOCTYPE html>
<html>
<head>

    <?php echo smarty_function_headerTemplate(array('assets' => 'jquery-ui|jquery-ui-base|datetime-picker'), $this);?>


<?php echo '
<style type="text/css">


input{
   margin: 5px;
}
select{
  margin: 5px;
}
</style>
'; ?>

<script language="Javascript">

<?php echo '
    function my_process () {
      // Pass the variable
      opener.document.prescribe.drug.value = document.lookup.drug.value;
      // Close the window
      window.self.close();
    }
'; ?>

</script>
<!---Gen Look up-->
<?php echo '
<script language=\'JavaScript\'>

 // This holds all the default drug attributes.
 // This was html escaped previously
'; ?>

 var drugopts = [<?php echo $this->_tpl_vars['DRUG_ATTRIBUTES']; ?>
];
<?php echo '

 // Helper to choose an option from its value.
 function selchoose(sel, value) {
  var o = sel.options;
  for (i = 0; i < o.length; ++i) {
   o[i].selected = (o[i].value == value);
  }
 }

 // Fill in default values when a drop-down drug is selected.
 function drugselected(sel) {
  var f = document.forms[0];
  var i = f.drug_id.selectedIndex - 1;
  if (i >= 0) {
   var d = drugopts[i];
   f.drug.value = d[0];
   selchoose(f.form, d[1]);
   f.dosage.value = d[2];
   f.size.value = d[3];
   f.rxnorm_drugcode.value = d[11];
   selchoose(f.unit, d[4]);
   selchoose(f.route, d[5]);
   selchoose(f.interval, d[6]);
   selchoose(f.substitute, d[7]);
   f.quantity.value = d[8];
   f.disp_quantity.value = d[8];
   selchoose(f.refills, d[9]);
   f.per_refill.value = d[10];
  }
 }

 // Invoke the popup to dispense a drug.
 function dispense() {
  var f = document.forms[0];
  dlgopen(\'interface/drugs/dispense_drug.php\' +
   '; ?>
'?drug_id=' + <?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->get_drug_id())) ? $this->_run_mod_handler('js_url', true, $_tmp) : js_url($_tmp)); ?>
 +<?php echo '
   \'&prescription=\' + encodeURIComponent(f.id.value) +
   \'&quantity=\' + encodeURIComponent(f.disp_quantity.value) +
   \'&fee=\' + encodeURIComponent(f.disp_fee.value),
   \'_blank\', 400, 200);
 }

 function quantityChanged() {
  var f = document.forms[0];
  f.per_refill.value = f.quantity.value;
  if (f.disp_quantity) {
   f.disp_quantity.value = f.quantity.value;
  }
 }

</script>
'; ?>

</head>
<body id="prescription_edit" class="body_top">

<form name="prescribe" id="prescribe"  method="post" action="<?php echo $this->_tpl_vars['FORM_ACTION']; ?>
" >
<table>
    <tr><td class="title"><font><b><?php echo smarty_function_xlt(array('t' => 'Add'), $this);?>
/<?php echo smarty_function_xlt(array('t' => 'Edit'), $this);?>
</b></font>&nbsp;</td>
    <td><a id="save" href=# onclick="submitfun();" class="css_button_small"><span><?php echo smarty_function_xlt(array('t' => 'Save'), $this);?>
</span></a>
    <?php if ($this->_tpl_vars['DRUG_ARRAY_VALUES']): ?>
    &nbsp; &nbsp; &nbsp; &nbsp;
        <?php if ($this->_tpl_vars['prescription']->get_refills() >= $this->_tpl_vars['prescription']->get_dispensation_count()): ?>
            <input type="submit" name="disp_button"class='css_button_small'  style="margin:0 5px 0 2px;" value="<?php echo smarty_function_xla(array('t' => 'Save and Dispense'), $this);?>
" />
            <input class="input-sm" type="text" name="disp_quantity" size="2" maxlength="10" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DISP_QUANTITY'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
            units, <?php echo ((is_array($_tmp=$this->_tpl_vars['GBL_CURRENCY_SYMBOL'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

            <input class="input-sm" type="text" name="disp_fee" size="5" maxlength="10" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DISP_FEE'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
        <?php else: ?>&nbsp;
            <?php echo smarty_function_xlt(array('t' => 'prescription has reached its limit of'), $this);?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->get_refills())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
 <?php echo smarty_function_xlt(array('t' => 'refills'), $this);?>
.
        <?php endif; ?>
    <?php endif; ?>
         <a id="back" class='css_button_small' href="controller.php?prescription&list&id=<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->patient->id)) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
"><span><?php echo smarty_function_xlt(array('t' => 'Back'), $this);?>
</span></a>
</td></tr>
</table>

<?php if ($this->_tpl_vars['GLOBALS']['enable_amc_prompting']): ?>
  <div style='float:right;margin-right:25px;border-style:solid;border-width:1px;'>
    <div style='float:left;margin:5px 5px 5px 5px;'>
      <?php echo smarty_function_amcCollect(array('amc_id' => 'e_prescribe_amc','patient_id' => $this->_tpl_vars['prescription']->patient->id,'object_category' => 'prescriptions','object_id' => $this->_tpl_vars['prescription']->id), $this);?>

      <?php if (! $this->_tpl_vars['amcCollectReturn']): ?>
        <input type="checkbox" id="escribe_flag" name="escribe_flag">
      <?php else: ?>
        <input type="checkbox" id="escribe_flag" name="escribe_flag" checked>
      <?php endif; ?>
      <span class="text"><?php echo smarty_function_xlt(array('t' => 'E-Prescription?'), $this);?>
</span><br>

      <?php echo smarty_function_amcCollect(array('amc_id' => 'e_prescribe_chk_formulary_amc','patient_id' => $this->_tpl_vars['prescription']->patient->id,'object_category' => 'prescriptions','object_id' => $this->_tpl_vars['prescription']->id), $this);?>

      <?php if (! $this->_tpl_vars['amcCollectReturn']): ?>
        <input type="checkbox" id="checked_formulary_flag" name="checked_formulary_flag">
      <?php else: ?>
        <input type="checkbox" id="checked_formulary_flag" name="checked_formulary_flag" checked>
      <?php endif; ?>
      <span class="text"><?php echo smarty_function_xlt(array('t' => 'Checked Drug Formulary?'), $this);?>
</span><br>

      <?php echo smarty_function_amcCollect(array('amc_id' => 'e_prescribe_cont_subst_amc','patient_id' => $this->_tpl_vars['prescription']->patient->id,'object_category' => 'prescriptions','object_id' => $this->_tpl_vars['prescription']->id), $this);?>

      <?php if (! $this->_tpl_vars['amcCollectReturn']): ?>
        <input type="checkbox" id="controlled_substance_flag" name="controlled_substance_flag">
      <?php else: ?>
        <input type="checkbox" id="controlled_substance_flag" name="controlled_substance_flag" checked>
      <?php endif; ?>
      <span class="text"><?php echo smarty_function_xlt(array('t' => 'Controlled Substance?'), $this);?>
</span><br>

    </div>
  </div>
<?php endif; ?>

<table CELLSPACING="0" CELLPADDING="3" BORDER="0">
<tr>
  <td COLSPAN="1" class="text input-sm" ALIGN="right" VALIGN="MIDDLE" ><?php echo smarty_function_xlt(array('t' => 'Currently Active'), $this);?>
</td>
  <td COLSPAN="2" ALIGN="LEFT" VALIGN="MIDDLE" >
    <input class="input-sm"type="checkbox" name="active" value="1"<?php if ($this->_tpl_vars['prescription']->get_active() > 0): ?> checked<?php endif; ?> />
  </td>
</tr>
<tr>
  <td COLSPAN="1" class="text" ALIGN="right" VALIGN="MIDDLE" ><?php echo smarty_function_xlt(array('t' => 'Starting Date'), $this);?>
</td>
  <td COLSPAN="2" ALIGN="LEFT" VALIGN="MIDDLE" >
      <input   type="text" size="10" class="datepicker" name="start_date" id="start_date" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['prescription']->start_date)) ? $this->_run_mod_handler('oeFormatShortDate', true, $_tmp) : oeFormatShortDate($_tmp)))) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
  </td>
</tr>
<tr>
  <td COLSPAN="1" class="text" ALIGN="right" VALIGN="MIDDLE" ><?php echo smarty_function_xlt(array('t' => 'Provider'), $this);?>
</td>
  <td COLSPAN="2" ALIGN="LEFT" VALIGN="MIDDLE" >
    <?php echo smarty_function_html_options(array('class' => "input-sm",'name' => 'provider_id','options' => $this->_tpl_vars['prescription']->provider->utility_provider_array(),'selected' => $this->_tpl_vars['prescription']->provider->get_id()), $this);?>

    <input type="hidden" name="patient_id" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->patient->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
  </td>
</tr>

<tr>
  <td COLSPAN="1" class="text" ALIGN="right" VALIGN="MIDDLE" ><?php echo smarty_function_xlt(array('t' => 'Drug'), $this);?>
</td>
  <td COLSPAN="2" ALIGN="LEFT" VALIGN="MIDDLE" >
            <input class="input-sm" type="input" size="35" name="drug" id="drug" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->drug)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"/>
            <a href="javascript:;" id="druglookup" class="small" name="B4" onclick="$('#hiddendiv').show(); document.getElementById('hiddendiv').innerHTML='&lt;iframe src=&quot;controller.php?prescription&amp;lookup&amp;drug=&quot; width=&quot;100%&quot;height=&quot;75&quot; scrolling=&quot;no&quot; frameborder=&quot;no&quot;&gt;&lt;/iframe&gt;'">
            (<?php echo smarty_function_xlt(array('t' => 'click here to search'), $this);?>
)</a>
            <div class="well well-sm" id="hiddendiv" style="display:none">&nbsp;</div>
  </td>
</tr>
<?php if ($this->_tpl_vars['DRUG_ARRAY_VALUES']): ?>
<tr>
  <td COLSPAN="1" class="text" ALIGN="right" VALIGN="MIDDLE" >&nbsp; <?php echo smarty_function_xlt(array('t' => 'in-house'), $this);?>
</td>
  <td COLSPAN="2" ALIGN="LEFT" VALIGN="MIDDLE" >
    <select class="input-sm" name="drug_id" onchange="drugselected(this)">
    <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['DRUG_ARRAY_VALUES'],'output' => $this->_tpl_vars['DRUG_ARRAY_OUTPUT'],'selected' => $this->_tpl_vars['prescription']->get_drug_id()), $this);?>

    </select>
        <input type="hidden" name="rxnorm_drugcode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->rxnorm_drugcode)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
  </td>
</tr>
<?php endif; ?>
<tr>
  <td COLSPAN="1" class="text" ALIGN="right" VALIGN="MIDDLE" ><?php echo smarty_function_xlt(array('t' => 'Quantity'), $this);?>
</td>
  <td COLSPAN="2" ALIGN="LEFT" VALIGN="MIDDLE" >
    <input class="input-sm" TYPE="TEXT" NAME="quantity" id="quantity" SIZE="10" MAXLENGTH="31"
     VALUE="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->quantity)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"
     onchange="quantityChanged()" />
  </td>
</tr>
<?php if ($this->_tpl_vars['SIMPLIFIED_PRESCRIPTIONS'] && ! $this->_tpl_vars['prescription']->size): ?>
<tr style='display:none;'>
<?php else: ?>
<tr>
<?php endif; ?>
  <td COLSPAN="1" class="text" ALIGN="right" VALIGN="MIDDLE" ><?php echo smarty_function_xlt(array('t' => 'Medicine Units'), $this);?>
</td>
  <td COLSPAN="2" ALIGN="LEFT" VALIGN="MIDDLE" >
    <input class="input-sm" TYPE="TEXT" NAME="size" id="size" SIZE="11" MAXLENGTH="10" VALUE="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->size)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"/>
    <select class="input-sm" name="unit" id="unit"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['prescription']->unit_array,'selected' => $this->_tpl_vars['prescription']->unit), $this);?>
</select>
  </td>
</tr>
<tr>
  <td COLSPAN="1" class="text" ALIGN="right" VALIGN="MIDDLE" ><?php echo smarty_function_xlt(array('t' => 'Directions'), $this);?>
</td>
  <td COLSPAN="2" class="text" ALIGN="LEFT" VALIGN="MIDDLE" >
<?php if ($this->_tpl_vars['SIMPLIFIED_PRESCRIPTIONS'] && ! $this->_tpl_vars['prescription']->form && ! $this->_tpl_vars['prescription']->route && ! $this->_tpl_vars['prescription']->interval): ?>
    <input class="input-sm" TYPE="text" NAME="dosage" id="dosage" SIZE="30" MAXLENGTH="100" VALUE="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->dosage)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
    <input type="hidden" name="form" id="form" value="0" />
    <input type="hidden" name="route" id="route" value="0" />
    <input type="hidden" name="interval" id="interval" value="0" />
<?php else: ?>
    <input class="input-sm" TYPE="TEXT" NAME="dosage" id="dosage" SIZE="2" MAXLENGTH="10" VALUE="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->dosage)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"/> <?php echo smarty_function_xlt(array('t' => 'in'), $this);?>

    <select class="input-sm" name="form" id="form"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['prescription']->form_array,'selected' => $this->_tpl_vars['prescription']->form), $this);?>
</select>
    <select class="input-sm" name="route" id="route"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['prescription']->route_array,'selected' => $this->_tpl_vars['prescription']->route), $this);?>
</select>
    <select class="input-sm" name="interval" id="interval"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['prescription']->interval_array,'selected' => $this->_tpl_vars['prescription']->interval), $this);?>
</select>
<?php endif; ?>
  </td>
</tr>
<tr>
  <td COLSPAN="1" class="text" ALIGN="right" VALIGN="MIDDLE" ><?php echo smarty_function_xlt(array('t' => 'Refills'), $this);?>
</td>
  <td COLSPAN="2" class="text" ALIGN="LEFT" VALIGN="MIDDLE" >
    <?php echo smarty_function_html_options(array('name' => 'refills','options' => $this->_tpl_vars['prescription']->refills_array,'selected' => $this->_tpl_vars['prescription']->refills), $this);?>

<?php if ($this->_tpl_vars['SIMPLIFIED_PRESCRIPTIONS']): ?>
    <input TYPE="hidden" ID="per_refill" NAME="per_refill" VALUE="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->per_refill)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
<?php else: ?>
    &nbsp; &nbsp; # <?php echo smarty_function_xlt(array('t' => 'of tablets'), $this);?>
:
    <input class="input-sm" TYPE="TEXT" ID="per_refill" NAME="per_refill" SIZE="2" MAXLENGTH="10" VALUE="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->per_refill)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
<?php endif; ?>
  </td>
</tr>
<tr>
  <td COLSPAN="1" class="text" ALIGN="right" VALIGN="MIDDLE" ><?php echo smarty_function_xlt(array('t' => 'Notes'), $this);?>
</td>
  <td COLSPAN="2" class="text" ALIGN="LEFT" VALIGN="MIDDLE" >
  <textarea class="form-control" name="note" cols="30" rows="1" wrap="virtual"><?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->note)) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</textarea>
  </td>
</tr>
<tr>
<?php if ($this->_tpl_vars['WEIGHT_LOSS_CLINIC']): ?>
  <td COLSPAN="1" class="text" ALIGN="right" VALIGN="MIDDLE" ><?php echo smarty_function_xlt(array('t' => 'Substitution'), $this);?>
</td>
  <td COLSPAN="2" ALIGN="LEFT" VALIGN="MIDDLE" >
    <?php echo smarty_function_html_options(array('name' => 'substitute','options' => $this->_tpl_vars['prescription']->substitute_array,'selected' => $this->_tpl_vars['prescription']->substitute), $this);?>

  </td>
<?php else: ?>
  <td COLSPAN="1" class="text input-sm" ALIGN="right" VALIGN="MIDDLE" ><?php echo smarty_function_xlt(array('t' => 'Add to Medication List'), $this);?>
</td>
  <td COLSPAN="2" class="text input-sm" ALIGN="LEFT" VALIGN="MIDDLE" >
    <?php echo smarty_function_html_radios(array('class' => "input-sm",'name' => 'medication','options' => $this->_tpl_vars['prescription']->medication_array,'selected' => $this->_tpl_vars['prescription']->medication), $this);?>

    &nbsp; &nbsp;
    <?php echo smarty_function_html_options(array('class' => "input-sm",'name' => 'substitute','options' => $this->_tpl_vars['prescription']->substitute_array,'selected' => $this->_tpl_vars['prescription']->substitute), $this);?>

  </td>
<?php endif; ?>
</tr>
</table>
<input type="hidden" name="id" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
<input type="hidden" name="process" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['PROCESS'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
<script language='JavaScript'>
<?php echo $this->_tpl_vars['ENDING_JAVASCRIPT']; ?>

</script>
</form>

<?php echo '
<!-- for the fancy jQuery stuff -->
<script type="text/javascript">


function submitfun() {
    top.restoreSession();
    if (CheckForErrors(this)) {
        document.forms["prescribe"].submit();
    }
    else {
        return false;
    }
}

function iframetopardiv(string){
    var name=string
    document.getElementById(\'drug\').value=name;
    $("#hiddendiv").html( "&nbsp;" );
    $(\'#hiddendiv\').hide();
}

function cancelParlookup () {
    $(\'#hiddendiv\').hide();
    $("#hiddendiv").html( "&nbsp;" );
}

$(function() {

    $("#save,#back").on("click",function(){
        $("#clearButton",window.parent.document).css("display", "none");
        $("#backButton",window.parent.document).css("display", "none");
        $("#addButton",window.parent.document).css("display", "");
    });

    '; ?>

    <?php if ($this->_tpl_vars['GLOBALS']['weno_rx_enable']): ?>
        <?php echo '
        $(\'#drug\').autocomplete({
            '; ?>

            source: 'library/ajax/drug_autocomplete/search.php?csrf_token_form=' + <?php echo ((is_array($_tmp=$this->_tpl_vars['CSRF_TOKEN_FORM'])) ? $this->_run_mod_handler('js_url', true, $_tmp) : js_url($_tmp)); ?>
,
            minLength: 3
            <?php echo '
        });
        '; ?>

    <?php else: ?>
        <?php echo '
        $(\'#drug\').autocomplete({
            '; ?>

            source: 'library/ajax/prescription_drugname_lookup.php?csrf_token_form=' + <?php echo ((is_array($_tmp=$this->_tpl_vars['CSRF_TOKEN_FORM'])) ? $this->_run_mod_handler('js_url', true, $_tmp) : js_url($_tmp)); ?>
,
            minLength: 1
            <?php echo '
        });
        '; ?>

    <?php endif; ?>
    <?php echo '

    $("#drug").focus();
    $("#prescribe").submit(function() { return CheckForErrors(this) });
});

// check the form for required fields before submitting
var CheckForErrors = function(eObj) {
    // REQUIRED FIELDS
    if (CheckRequired(\'drug\') == false) { return false; }
    if (CheckRequired(\'quantity\') == false) { return false; }
    //if (CheckRequired(\'unit\') == false) { return false; }
    //if (CheckRequired(\'size\') == false) { return false; }
    if (CheckRequired(\'dosage\') == false) { return false; }
    //if (CheckRequired(\'form\') == false) { return false; }
    //if (CheckRequired(\'route\') == false) { return false; }
    //if (CheckRequired(\'interval\') == false) { return false; }

    return top.restoreSession();
};

function CheckRequired(objID) {

    // for text boxes
    if ($(\'#\'+objID).is(\'input\')) {
        if ($(\'#\'+objID).val() == "") {
            alert('; ?>
<?php echo smarty_function_xlj(array('t' => 'Missing a required field and will be highlighted'), $this);?>
<?php echo ');
            $(\'#\'+objID).css("backgroundColor", "pink");
            return false;
        }
    }

    // for select boxes
    if ($(\'#\'+objID).is(\'select\')) {
        if ($(\'#\'+objID).val() == "0") {
            alert('; ?>
<?php echo smarty_function_xlj(array('t' => 'Missing a required field'), $this);?>
<?php echo ');
            $(\'#\'+objID).css("backgroundColor", "pink");
            return false;
        }
    }

    return true;
}


$(function(){'; ?>

    <?php echo smarty_function_datetimepickerSupport(array('input' => 'format'), $this);?>

<?php echo '});</script>



'; ?>


</html>