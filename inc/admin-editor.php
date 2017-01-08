<table id="style_selector" width="100%" border="0" cellpadding="10" cellspacing="0" style="border:1px solid #fff; border-bottom:none; table-layout:fixed">
    	<colgroup>
        <col style="background:#f8f8f8 url('<?php echo plugins_url('/assets/images/table.png', dirname(__FILE__)); ?>') repeat-x 0 bottom; width:150px;" />
        <col style="background:#f8f8f8 url('<?php echo plugins_url('/assets/images/table.png', dirname(__FILE__)); ?>') repeat-x 0 bottom; width:260px;" />
        <col />
      </colgroup>
      <tr>
        <td><p class="row_title"><a class="question" href="#">Info</a> <span class="info">Checking this box will mean that your style will apply to selected words within a paragraph, rather than the whole paragraph itself.</span> Inline?</p></td>
        <td><p>
      <input name="jck_custom_styles[inline]" id="inline" type="checkbox" value="inline"  <?php checked(jck_custom_styles::get_value('inline'), 'inline'); ?> />
    </p></td>
    <td rowspan="17" style="background:#fff; padding:20px; position:relative; vertical-align:top; border-left:1px solid #ddd;">
        	<div class="postbox prev_div">
            <h3><span>Live Preview</span></h3>
            <div class="inside">

              <div style="display:<?php echo (jck_custom_styles::get_value('inline') != 'inline') ? 'block' : 'none'; ?>;"><p id="preview" style=' <?php echo $current_styles; ?> '>Preview text lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam et neque nisl, porttitor ultricies risus.</p></div>
                        <div style="display:<?php echo (jck_custom_styles::get_value('inline') == 'inline') ? 'block' : 'none'; ?>;"><p>Preview text <span id="preview_inline" style=' <?php echo $current_styles; ?> '>lorem ipsum</span> dolor sit amet, consectetur adipiscing elit. Aliquam et neque nisl, porttitor ultricies risus.</p></div>

            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td><p>Font Family</p></td>
        <td><p>
    	<select name="jck_custom_styles[fontFamily]" id="fontFamily">
        <option value="inherit" <?php selected(jck_custom_styles::get_value('fontFamily'), 'inherit'); ?>>Inherit</option>
        <option value="courier, &quot;courier new&quot;, monospace" <?php selected(jck_custom_styles::get_value('fontFamily'), 'courier, "courier new", monospace'); ?>>Courier</option>
        <option value="georgia, serif" <?php selected(jck_custom_styles::get_value('fontFamily'), 'georgia, serif'); ?>>Georgia</option>
        <option value="&quot;palatino linotype&quot;, palatino, serif" <?php selected(jck_custom_styles::get_value('fontFamily'), '"palatino linotype", palatino, serif'); ?>>Palatino</option>
        <option value="&quot;times new roman&quot;, times, serif" <?php selected(jck_custom_styles::get_value('fontFamily'), '"times new roman", times, serif'); ?>>Times New Roman</option>
        <option value="arial, sans-serif" <?php selected(jck_custom_styles::get_value('fontFamily'), 'arial, sans-serif'); ?>>Arial</option>
        <option value="helvetica, sans-serif" <?php selected(jck_custom_styles::get_value('fontFamily'), 'helvetica, sans-serif'); ?>>Helvetica</option>
        <option value="impact, sans-serif" <?php selected(jck_custom_styles::get_value('fontFamily'), 'impact, sans-serif'); ?>>Impact</option>
        <option value="&quot;lucida sans unicode&quot;, &quot;lucida grande&quot;, sans-serif" <?php selected(jck_custom_styles::get_value('fontFamily'), '"lucida sans unicode", "lucida grande", sans-serif'); ?>>Lucida Sans</option>
        <option value="&quot;trebuchet MS&quot;, sans-serif" <?php selected(jck_custom_styles::get_value('fontFamily'), '"trebuchet MS", sans-serif'); ?>>Trebuchet MS</option>
        <option value="verdana, sans-serif" <?php selected(jck_custom_styles::get_value('fontFamily'), 'verdana, sans-serif'); ?>>Verdana</option>
      </select>
    </p></td>
      </tr>
      <tr>
        <td><p>Font Size</p></td>
        <td><p>
        <input type="number" name="jck_custom_styles[fontSize]" id="fontSize" value="<?php echo jck_custom_styles::get_value('fontSize'); ?>" />

        <select name="jck_custom_styles[fontSizeMeas]" id="fontSizeMeas" >
		  <option value="px" <?php selected(jck_custom_styles::get_value('fontSizeMeas'), 'px'); ?>>px</option>
		  <option value="em" <?php selected(jck_custom_styles::get_value('fontSizeMeas'), 'em'); ?>>em</option>
		  <option value="%" <?php selected(jck_custom_styles::get_value('fontSizeMeas'), '%'); ?>>%</option>
		</select>
    </p></td>
      </tr>
      <tr>
        <td><p class="row_title"><a class="question" href="#">Info</a> <span class="info">Upon clicking the field, a colour picker will appear. Use the settings to choose your desired colour and then click the colour wheel in the bottom right to choose it.</span> Font Colour</p></td>
        <td><p>
      <input class="color" name="jck_custom_styles[color]" id="color" value="<?php echo jck_custom_styles::get_value('color'); ?>" />
    </p></td>
      </tr>
      <tr>
        <td><p>Font Style</p></td>
        <td><p class="hider">
    	<a class="toggle<?php echo (jck_custom_styles::get_value('fontWeight') == 'bold') ? ' on' : ''; ?>" href="#" id="fontWeight_toggle">Bold</a>
      <input type="checkbox" name="jck_custom_styles[fontWeight]" id="fontWeight" value="bold" <?php checked(jck_custom_styles::get_value('fontWeight'), 'bold'); ?> />

      <a class="toggle<?php echo (jck_custom_styles::get_value('fontStyle') == 'italic') ? ' on' : ''; ?>" href="#" id="fontStyle_toggle">Italic</a>
      <input type="checkbox" name="jck_custom_styles[fontStyle]" id="fontStyle" value="italic" <?php checked(jck_custom_styles::get_value('fontStyle'), 'italic'); ?> />
    </p></td>
      </tr>
      <tr>
        <td><p>Text Decoration</p></td>
        <td><p class="hider">
      <a class="toggle<?php echo (jck_custom_styles::get_value('textDecoration') == 'underline') ? ' on' : ''; ?>" href="#" id="textDecoration_underline">Underline</a>
      <input type="radio" name="jck_custom_styles[textDecoration]" title="textDecoration" value="underline" <?php checked(jck_custom_styles::get_value('textDecoration'), 'underline'); ?> />

      <a class="toggle<?php echo (jck_custom_styles::get_value('textDecoration') == 'line-through') ? ' on' : ''; ?>" href="#" id="textDecoration_linethrough">Line-through</a>
      <input type="radio" name="jck_custom_styles[textDecoration]" title="textDecoration" value="line-through" <?php checked(jck_custom_styles::get_value('textDecoration'), 'line-through'); ?> />
    </p></td>
      </tr>
      <tr>
        <td><p>Text Transform</p></td>
        <td><p>
      	<select name="jck_custom_styles[textTransform]" id="textTransform" >
          <option value="none" <?php selected(jck_custom_styles::get_value('textTransform'), 'none'); ?>>None</option>
          <option value="capitalize" <?php selected(jck_custom_styles::get_value('textTransform'), 'capitalize'); ?>>Capitalize</option>
          <option value="uppercase" <?php selected(jck_custom_styles::get_value('textTransform'), 'uppercase'); ?>>Uppercase</option>
          <option value="lowercase" <?php selected(jck_custom_styles::get_value('textTransform'), 'lowercase'); ?>>Lowercase</option>
          <option value="inherit" <?php selected(jck_custom_styles::get_value('textTransform'), 'inherit'); ?>>Inherit</option>
        </select>
    </p></td>
      </tr>
      <tr>
        <td><p>Text Align</p></td>
        <td><p class="hider">
      <a class="toggle<?php echo (jck_custom_styles::get_value('textAlign') == 'left') ? ' on' : ''; ?>" href="#" id="textAlign_left">Left</a>
      <input type="radio" name="jck_custom_styles[textAlign]" title="textAlign" value="left" <?php checked(jck_custom_styles::get_value('textAlign'), 'left'); ?> />

      <a class="toggle<?php echo (jck_custom_styles::get_value('textAlign') == 'center') ? ' on' : ''; ?>" href="#" id="textAlign_center">Center</a>
      <input type="radio" name="jck_custom_styles[textAlign]" title="textAlign" value="center" <?php checked(jck_custom_styles::get_value('textAlign'), 'center'); ?> />

      <a class="toggle<?php echo (jck_custom_styles::get_value('textAlign') == 'right') ? ' on' : ''; ?>" href="#" id="textAlign_right">Right</a>
      <input type="radio" name="jck_custom_styles[textAlign]" title="textAlign" value="right" <?php checked(jck_custom_styles::get_value('textAlign'), 'right'); ?> />

      <a class="toggle<?php echo (jck_custom_styles::get_value('textAlign') == 'justify') ? ' on' : ''; ?>" href="#" id="textAlign_justify">Justify</a>
      <input type="radio" name="jck_custom_styles[textAlign]" title="textAlign" value="justify" <?php checked(jck_custom_styles::get_value('textAlign'), 'justify'); ?> />
    </p></td>
      </tr>
      <tr>
        <td><p>Letter Spacing</p></td>
        <td><p>
        <input type="number" name="jck_custom_styles[letterSpacing]" id="letterSpacing" value="<?php echo jck_custom_styles::get_value('letterSpacing'); ?>" /> px
    </p></td>
      </tr>
      <tr>
        <td><p>Word Spacing</p></td>
        <td><p>
        <input type="number" name="jck_custom_styles[wordSpacing]" id="wordSpacing" value="<?php echo jck_custom_styles::get_value('wordSpacing'); ?>" /> px
    </p></td>
      </tr>
      <tr>
        <td><p>Line Height</p></td>
        <td><p>
        <input type="number" name="jck_custom_styles[lineHeight]" id="lineHeight" value="<?php echo jck_custom_styles::get_value('lineHeight'); ?>" />
        <select name="jck_custom_styles[lineHeightMeas]" id="lineHeightMeas" >
		  <option value="px" <?php selected(jck_custom_styles::get_value('lineHeightMeas'), 'px'); ?>>px</option>
		  <option value="em" <?php selected(jck_custom_styles::get_value('lineHeightMeas'), 'em'); ?>>em</option>
		  <option value="%" <?php selected(jck_custom_styles::get_value('lineHeightMeas'), '%'); ?>>%</option>
		</select>
    </p></td>
      </tr>
      <tr>
        <td><p class="row_title"><a class="question" href="#">Info</a> <span class="info">Upon clicking the field, a colour picker will appear. Use the settings to choose your desired colour and then click the colour wheel in the bottom right to choose it.</span> Background Colour</p></td>
        <td><p>
        <input class="color" name="jck_custom_styles[backgroundColor]" id="backgroundColor" value="<?php echo jck_custom_styles::get_value('backgroundColor'); ?>" />
    </p></td>
      </tr>
      <tr>
        <td><p>Margin <br />
            <input type="checkbox" class="choose_individuals" name="jck_custom_styles[margin_ind]" id="margin_ind" value="margin_ind" <?php checked(jck_custom_styles::get_value('margin_ind'), 'margin_ind'); ?> />
            <em>Each side?</em></p></td>
        <td><p>
            <input type="number" class="mainField" name="jck_custom_styles[margin]" id="margin" value="<?php echo jck_custom_styles::get_value('margin'); ?>" <?php disabled(jck_custom_styles::get_value('margin_ind'), 'margin_ind'); ?> />
            px </p>
          <?php if (jck_custom_styles::get_value('margin_ind') == 'margin_ind') {
      $display = 'block';
    } //jck_custom_styles::get_value('margin_ind') == 'margin_ind'
    else {
      $display = 'none';
    } ?>
          <div style="clear:both; margin:1em 0; display:<?php echo $display; ?>;" id="margin_sides" class="individuals">
            <input type="number" name="jck_custom_styles[margin-top]" id="margin-top" value="<?php echo jck_custom_styles::get_value('margin-top'); ?>" />
            px (top)<br />
            <input type="number" name="jck_custom_styles[margin-right]" id="margin-right" value="<?php echo jck_custom_styles::get_value('margin-right'); ?>" />
            px (right)<br />
            <input type="number" name="jck_custom_styles[margin-bottom]" id="margin-bottom" value="<?php echo jck_custom_styles::get_value('margin-bottom'); ?>" />
            px (bottom)<br />
            <input type="number" name="jck_custom_styles[margin-left]" id="margin-left" value="<?php echo jck_custom_styles::get_value('margin-left'); ?>" />
            px (left)<br />
          </div></td>
      </tr>
      <tr>
        <td><p>Padding <br />
            <input type="checkbox" class="choose_individuals" name="jck_custom_styles[padding_ind]" id="padding_ind" value="padding_ind" <?php checked(jck_custom_styles::get_value('padding_ind'), 'padding_ind'); ?> />
            <em>Each side?</em></p></td>
        <td><p>
            <input type="number" class="mainField" name="jck_custom_styles[padding]" id="padding" value="<?php echo jck_custom_styles::get_value('padding'); ?>" <?php disabled(jck_custom_styles::get_value('padding_ind'), 'padding_ind'); ?> />
            px </p>
          <?php if (jck_custom_styles::get_value('padding_ind') == 'padding_ind') {
      $display = 'block';
    } //jck_custom_styles::get_value('padding_ind') == 'padding_ind'
    else {
      $display = 'none';
    } ?>
          <div style="clear:both; margin:1em 0; display:<?php echo $display; ?>;" id="padding_sides" class="individuals">
            <input type="number" name="jck_custom_styles[padding-top]" id="padding-top" value="<?php echo jck_custom_styles::get_value('padding-top'); ?>" />
            px (top)<br />
            <input type="number" name="jck_custom_styles[padding-right]" id="padding-right" value="<?php echo jck_custom_styles::get_value('padding-right'); ?>" />
            px (right)<br />
            <input type="number" name="jck_custom_styles[padding-bottom]" id="padding-bottom" value="<?php echo jck_custom_styles::get_value('padding-bottom'); ?>" />
            px (bottom)<br />
            <input type="number" name="jck_custom_styles[padding-left]" id="padding-left" value="<?php echo jck_custom_styles::get_value('padding-left'); ?>" />
            px (left)<br />
          </div></td>
      </tr>
      <tr>
        <td><p>Border Style</p></td>
        <td><p>
        <select name="jck_custom_styles[borderStyle]" id="borderStyle">
        	<option value="none" <?php selected(jck_custom_styles::get_value('borderStyle'), 'none'); ?>>None</option>
          <option value="hidden" <?php selected(jck_custom_styles::get_value('borderStyle'), 'hidden'); ?>>Hidden</option>
          <option value="dotted" <?php selected(jck_custom_styles::get_value('borderStyle'), 'dotted'); ?>>Dotted</option>
          <option value="dashed" <?php selected(jck_custom_styles::get_value('borderStyle'), 'dashed'); ?>>Dashed</option>
          <option value="solid" <?php selected(jck_custom_styles::get_value('borderStyle'), 'solid'); ?>>Solid</option>
          <option value="double" <?php selected(jck_custom_styles::get_value('borderStyle'), 'double'); ?>>Double</option>
          <option value="groove" <?php selected(jck_custom_styles::get_value('borderStyle'), 'groove'); ?>>Groove</option>
          <option value="ridge" <?php selected(jck_custom_styles::get_value('borderStyle'), 'ridge'); ?>>Ridge</option>
          <option value="inset" <?php selected(jck_custom_styles::get_value('borderStyle'), 'inset'); ?>>Inset</option>
          <option value="outset" <?php selected(jck_custom_styles::get_value('borderStyle'), 'outset'); ?>>Outset</option>
      </select>
        </p></td>
      </tr>
      <tr>
        <td><p class="row_title"><a class="question" href="#">Info</a> <span class="info">Upon clicking the field, a colour picker will appear. Use the settings to choose your desired colour and then click the colour wheel in the bottom right to choose it.</span> Border Colour</p></td>
        <td><p><input class="color" name="jck_custom_styles[borderColor]" id="borderColor" value="<?php echo jck_custom_styles::get_value('borderColor'); ?>" /></p></td>
      </tr>
      <tr>
        <td><p>Border Width<br />
            <input type="checkbox" class="choose_individuals" name="jck_custom_styles[border_ind]" id="border_ind" value="border_ind" <?php checked(jck_custom_styles::get_value('border_ind'), 'border_ind'); ?> />
            <em>Each side?</em></p></td>
        <td><p>
            <input type="number" class="mainField" name="jck_custom_styles[border-width]" id="border-width" value="<?php echo jck_custom_styles::get_value('border-width'); ?>" <?php disabled(jck_custom_styles::get_value('border_ind'), 'border_ind'); ?> />
            px </p>
          <?php if (jck_custom_styles::get_value('border_ind') == 'border_ind') {
      $display = 'block';
    } //jck_custom_styles::get_value('border_ind') == 'border_ind'
    else {
      $display = 'none';
    } ?>
          <div style="clear:both; margin:1em 0; display:<?php echo $display; ?>;" id="border_sides" class="individuals">
            <input type="number" name="jck_custom_styles[border-top-width]" id="border-top-width" value="<?php echo jck_custom_styles::get_value('border-top-width'); ?>" />
            px (top)<br />
            <input type="number" name="jck_custom_styles[border-right-width]" id="border-right-width" value="<?php echo jck_custom_styles::get_value('border-right-width'); ?>" />
            px (right)<br />
            <input type="number" name="jck_custom_styles[border-bottom-width]" id="border-bottom-width" value="<?php echo jck_custom_styles::get_value('border-bottom-width'); ?>" />
            px (bottom)<br />
            <input type="number" name="jck_custom_styles[border-left-width]" id="border-left-width" value="<?php echo jck_custom_styles::get_value('border-left-width'); ?>" />
            px (left)<br />
          </div></td>
      </tr>
    </table>