<?php
if ( @ !$_GET['atom'] )
{
	echo '<html>'
		. '<head>'
		. '<title>atom2rss converter &bull; Atom to RSS2 converter</title>'
		. '<style>'
		. 'body { padding: 20px 40px; font-family: Verdana, Helvetica, Sans-Serif; font-size: medium; }'
		. '</style>'
		. '</head>'
		. '<body>'
		. '<form>'
		. '<h1>atom2rss converter</h1>'
		. '<p>'
			. 'This tool will let you convert your blogger atom feed into an RSS2 feed that can be imported into WordPress.'
			. '</p>'
		. '<p>'
			. 'Please read the full instructions before starting.'
			. '</p>'
		. '<p>'
			. '<input type="text" name="atom" style="width: 400px;">'
			. '<input type="submit" value="Convert">'
			. '</p>'
		. '<h2>Instructions</h2>'
		. '<p>'
			. '<strong>Step 1</strong>: Enter the url of an atom feed urls, e.g. <i>http://yoursite.com/atom.xml</i><br />'
			. '</p>'
		. '<p>'
			. '<strong>Step 2</strong>: After clicking the submit button, head to File / Save As... and save the file as rss.xml to your desktop.'
			. '</p>'
		. '<p>'
			. '<strong>Step 3</strong>: You can then use this rss.xml file to import your blogger data into WordPress under Import / RSS.'
			. '</p>'
		. '<h2>About</h2>'
		. '<p>'
			. 'This tool is online as a convenience for <a href="http://www.getsemiologic.com">Semiologic Pro</a> users. And whoever else may need it.'
			. '</p>'
		. '</form>'
		. '</body>'
		. '</html>';
}
else
{
	$chan = new DOMDocument();
	$chan->load($_GET['atom']);

	$sheet = new DOMDocument();
	$sheet->load('atom2rss.xsl');

	$processor = new XSLTProcessor();
	$processor->importStylesheet($sheet);

	$result = @$processor->transformToXML($chan);

	header('Content-Type: text/xml; Charset: UTF-8');
	echo $result;
}
?>
