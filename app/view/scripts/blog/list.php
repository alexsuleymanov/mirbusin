	<table cellspacing="15" border="0" width="100%">
		<tr>
<?		foreach($this->articles as $k => $v){?>
			<td width="100" valign="top"><a href="<?=$this->url->mkd(array(1, "article", 2, $v->intname))?>" class="newsh"><span class="date"><?echo date("d.m.Y", $v->tstamp);?></span></a></td>
			<td><a href="<?=$this->url->mkd(array(1, "article", 2, $v->intname))?>" class="newsh"><?=$v->name?></a>
				<br><?=substr(strip_tags($v->cont, "<a>"), 0, 500)."...";?>
			</td>
		</tr>
<?
		}?>
	</table>