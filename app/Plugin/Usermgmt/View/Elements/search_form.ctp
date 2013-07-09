<div class="searchForm">
<?php
$isAjax=true;
if(isset($options['useAjax']) && !$options['useAjax']) {
	$isAjax=false;
}
$clear=true;
if(isset($options['clear']) && !$options['clear']) {
	$clear=false;
}
$targetAction=$this->request->action;
if(!empty($this->request->params['pass'])) {
	foreach($this->request->params['pass'] as $pass) {
		$targetAction .='/'.$pass;
	}
}
if($isAjax) {
	$data = $this->Js->get('#'.$modelName.'Usermgmt')->serializeForm(array('isForm' => true, 'inline' => true));
	$this->Js->get('#'.$modelName.'Usermgmt')->event(
		  'submit',
		  $this->Js->request(
			array('action' => $targetAction),
			array(
					'update' => '#'.$options['updateDivId'],
					'before' => '$("#'.$options['updateDivId'].'").html(\'<div class="loadning-indicator"></div>\');',
					'data' => $data,
					'async' => true,
					'dataExpression'=>true,
					'method' => 'POST'
				)
			)
		);
}
?>
<?php
	echo $this->Form->create(false, array('url' => '/'.$this->request->url, 'id' => $modelName.'Usermgmt'));
	if (isset($options['legend'])) {
		echo "<div class='searchTitle'>".$options['legend']."</div>";
	}
	echo $this->Form->input('Usermgmt.searchFormId', array('type' => 'hidden', 'value' => $modelName));

	if (isset($viewSearchParams)) {
		$jq = "<script type='text/javascript'>";
		foreach ($viewSearchParams as $field) {
			$search_multiple=false;
			$searchFunc=false;
			$search_tagline='';
			$search_options= $field['options'];
			if($search_options['condition'] =='multiple') {
				$search_multiple=true;
			}
			if(!empty($search_options['tagline'])) {
				$search_tagline=$search_options['tagline'];
			}
			if(!empty($search_options['searchFunc'])) {
				$searchFunc=$search_options['searchFunc'];
			}
			unset($search_options['condition'], $search_options['tagline'], $search_options['searchFunc']);
			$search_level = $search_options['label'];
			$search_options['label'] = false;
			$search_options['div'] = false;
			$search_options['autoComplete'] = "off";
			echo "<div style='float:left;margin-top:10px;margin-bottom: 5px;'>";
			if($search_level) {
				echo "<div class='tl'>".$this->Form->label(__($search_level))."</div>";
			}
			echo "<div class='tf'>";
			if(!empty($search_tagline)) {
				echo "<span style='font-style:italic;margin-top: 27px;position: absolute;'>".$search_tagline."</span>";
			}
			echo $this->Form->input($field['name'], $search_options);
			$loadingId = uniqid();
			if($search_options['type']=="text" && (!$search_multiple || $searchFunc)) {
				echo "<span id='".$loadingId."' style='position: absolute;margin-left: -25px;margin-top: 4px;display:none'>".$this->Html->image(SITE_URL.'usermgmt/img/loading-circle.gif')."</span>";
			}
			echo "</div>";
			echo "</div>";
			if($search_options['type']=="text" && (!$search_multiple || $searchFunc)) {
				$parts = array_values(Set::filter(explode('.', $field['name']), true));
				$fieldModel = $modelName;
				$fieldName = $search_options['field'];
				if(isset($parts[1])) {
					$fieldModel = $parts[0];
					$fieldName = $parts[1];
				}
				$fieldId = $fieldModel.Inflector::camelize($fieldName);
				if($searchFunc) {
					$url = SITE_URL;
					if(!empty($searchFunc['plugin'])) {
						$url .=$searchFunc['plugin'].'/';
					}
					$url .=$searchFunc['controller'].'/'.$searchFunc['function'];
				} else {
					$url = SITE_URL."usermgmt/autocomplete/fetch/".$fieldModel."/".$fieldName;
				}
				$jq .=  "$(function() {
							var cache = {},
								lastXhr;
							$('#".$fieldId."').autocomplete({
								minLength: 2,
								source: function( request, response ) {
									var term = request.term;
									$('#".$loadingId."').css('display', '');
									if ( term in cache ) {
										$('#".$loadingId."').hide();
										response( cache[ term ] );
										return;
									}
									lastXhr = $.getJSON( '".$url."', request, function( data, status, xhr ) {
										cache[ term ] = data;
										if ( xhr === lastXhr ) {
											$('#".$loadingId."').hide();
											response( data );
										}
									});
								}
							});
						});";
			}
		}
		$jq .="$(function() {
					$('#searchButtonId').click(function(){
						$('#searchClearId').val(1);
						$('#searchSubmitId').trigger('click');
					});
				});";
		$jq .="</script>";
		echo $jq;
	}
	if($clear) {
		echo "<div class='search_submit'>".$this->Form->hidden("search_clear", array('id' => 'searchClearId', 'value' => 0))."<button type='button' id='searchButtonId' class='btn btn-danger'>Clear</button></div>";
	}
	echo "<div class='search_submit'>".$this->Form->submit(__('Search'), array('div'=>false, 'id' => 'searchSubmitId', 'class'=>'btn btn-primary'))."</div>";
	echo "<div style='clear:both'></div>";
	$this->Form->unlockField('search_clear');
	echo $this->Form->end();
	echo $this->Js->writeBuffer();
?>
</div>