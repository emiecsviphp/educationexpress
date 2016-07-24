<?php 
/**
 * Form Helper
 *
 * @package Education Express Plugin
 * 
 *  a helper intended for the use of Education Express Plugin
 *
 */

class FormHelper	{
	
	function __construct()	{
		/* nothing */
	}
	
	/**
	 * method dropDownObj
	 *
	 * $obj - (string)|(required) - object that cane be filter e.g. 'schools', 'degrees', 'studies'
	 * $echo - (boolean)|(optional) - set to 1 to display the dropdown otherwise it will return the row results
	 * $css_class - (string)|(optional) - the css classname of the dropdown
	 * $selectedvalue - (int)|(optional) - selected value
	 * $customid - (string)|(optional) - the id of the dropdown
	 * $emptylabel - (string)|(optional) - the label for the empty value, default is "Select ....", can be set "All", "All School", etc
	 */
	function dropDownObj($obj, $echo=null, $css_class=null, $selectedvalue=null, $customid=null, $emptylabel=null )	{
		if($obj == 'schools')
			$rows = SchoolsModel::get_by_status('','name',1);
		if($obj == 'degrees')
			$rows = DegreesModel::get_by_status('','name',1);
		if($obj == 'studies')
			$rows = StudiesModel::get_by_status('','name',1);	
	
		if($echo)	{
			if($css_class != '')
				$css_style='class="'.$css_class.'"';
			else
				$css_style='';
			
			
			if($customid != '')	
				$customid = $customid;
			else
				$customid = $obj;
			
			if($emptylabel != '')
				$textlabel = $emptylabel;
			else	
				$textlabel = 'Select '.ucfirst($obj);
				
			$str_dropdown = '';
			$str_dropdown .= '<select id="'.$customid.'" name="'.$customid.'" '.$css_style.' >';
			$str_dropdown .= '	<option value="">'.$textlabel.'</option>';
				if(count($rows) > 0)	{
					foreach($rows as $row)	{
					
						if($row->id == $selectedvalue)
							$selected='selected';
						else
							$selected='';
					
						$str_dropdown .= '<option value="'.$row->id.'" '.$selected.' >'.stripslashes($row->name).'</option>';
					}
				}
			$str_dropdown .= '</select>';
			echo $str_dropdown;
		}
		else	{
			return $rows;
		}
	}

	/**
	 * method listObj
	 *
	 * $obj - (string)|(required) - object that cane be filter e.g. 'schools', 'degrees', 'studies'
	 * $echo - (boolean)|(optional) - set to 1 to display the dropdown otherwise it will return the row results
	 * $css_class - (string)|(optional) - the css classname of the dropdown
	 * $orderedlist - (boolean)|(optional) - set to 1 to display the order list otherwise unorder list
	 * $linkable - (boolean)|(optional) - set to 1 to display <a> tag
	 * $linkable - (boolean)|(optional) - set to 1 to display the default link of the object
	 * $onclickfunc - (string)|(optional) - function name for onclick event especially used for ajax
	 */
	function listObj($obj, $echo=null, $css_class=null, $orderedlist=null, $linkable=null, $linkurl=null, $onclickfunc=null)	{
		if($obj == 'schools')
			$rows = SchoolsModel::get_by_status('','name',1);
		if($obj == 'degrees')
			$rows = DegreesModel::get_by_status('','name',1);
		if($obj == 'studies')
			$rows = StudiesModel::get_by_status('','name',1);	
	
		if($echo)	{
			if($css_class != '')
				$css_style='class="'.$css_class.'"';
			else
				$css_style='';

			if($orderedlist)
				$listtype='ol';
			else
				$listtype='ul';
			
			$href = '';
			
			$str_list = '';
			if(count($rows) > 0)	{
				$str_list .= '<'.$listtype.' id="list-'.$obj.'" '.$css_style.' >';					
					foreach($rows as $row)	{
						$str_list .= '<li id="list-'.$row->id.'" >';
						
						if($onclickfunc != '')
							$onclick='onclick="'.$onclickfunc.'(\''.$row->id.'\')"';
						else
							$onclick='';
						
						if($linkurl)
							$href = 'href="?'.$obj.'='.$row->id.'"';

						if($linkable)	{
							$str_list .= '<a style="cursor:pointer;" '.$href.' '.$onclick.'>';
						}
						$str_list .= ucfirst(stripslashes($row->name));
						if($linkable)	{
							$str_list .= ' </a>';
						}
						
						$str_list .= '</li>';
					}
				$str_list .= '</'.$listtype.'>';
			}
			echo $str_list;
		}
		else	{
			return $rows;
		}
	}
	
}
