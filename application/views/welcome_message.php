<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>
    As seen on <a href="https://github.com/brown078/RFQ993471"> https://github.com/brown078/RFQ993471 </a> please go there to review the code
<article class="markdown-body entry-content" itemprop="mainContentOfPage"><h1><a id="user-content-drug-search-restful-interface-and-sample-html5-mobile-application" class="anchor" href="#drug-search-restful-interface-and-sample-html5-mobile-application" aria-hidden="true"><span class="octicon octicon-link"></span></a>Drug Search RESTFul Interface and Sample HTML5 Mobile Application</h1>

<h2><a id="user-content-prototype-urls" class="anchor" href="#prototype-urls" aria-hidden="true"><span class="octicon octicon-link"></span></a>Prototype URLS</h2>

<h3><a id="user-content-responsive-html-sample-prototype" class="anchor" href="#responsive-html-sample-prototype" aria-hidden="true"><span class="octicon octicon-link"></span></a>Responsive HTML Sample Prototype</h3>

<p><a href="http://rfq993471.technicate.com/RFQ993471/sample_mobile_frontend">http://rfq993471.technicate.com/RFQ993471/sample_mobile_frontend</a></p>

<h3><a id="user-content-web-service-endpoint-jsonp-callback-output" class="anchor" href="#web-service-endpoint-jsonp-callback-output" aria-hidden="true"><span class="octicon octicon-link"></span></a>Web Service Endpoint (JSONP Callback output)</h3>

<p><a href="http://rfq993471.technicate.com/RFQ993471/index.php/FDARequest/drugsearch/zantac">http://rfq993471.technicate.com/RFQ993471/index.php/FDARequest/drugsearch/zantac</a></p>

<h2><a id="user-content-description" class="anchor" href="#description" aria-hidden="true"><span class="octicon octicon-link"></span></a>Description</h2>

<p>Technicate used the human centered approach of inspiration, idea &amp; implementation to develop this application.  We interviewed employees and others, 5 subjects, on the usefulness of a mobile or web application that provided all of the data the FDA has on a specific drug.  The feedback was very positive, such as, using it to find out proper dosage or warnings of medications prescribed.  Ideas included reading directions in the middle of the night without having to "fumble for them".  As a result, we had an idea phase (screenshots included) where we chose our technical approach (below) and implementation team.</p>

<p>Technicate Solution's Drug Search is written in PHP5 and the CodeIgnitor 3.0 MVC based framework.<br>
The web service endpoint serves as a prototype platform for connecting to the <a href="http://open.fda.gov">http://open.fda.gov</a> API and datasets to pull single descriptions of medications based on a generic or brand name openfda search term.  It includes a sample MySQL database schema to cache these results coming from the FDA into.  This would minimize the amount of requests set to an external system, such as open.fda.gov.<br>
This application can be easily served on a cloud VPS using a standard Linux, Apache2, PHP5 and MySQL (LAMP) instance.  It includes a sample responsive HTML based web site and mobile site, written using JQuery and JQuery Mobile, as an example application that would use this caching system. </p>

<h2><a id="user-content-technologies-used" class="anchor" href="#technologies-used" aria-hidden="true"><span class="octicon octicon-link"></span></a>Technologies Used</h2>

<ul>
<li>PHP5 <a href="http://www.php.net">http://www.php.net</a></li>
<li>CodeIgnitor 3.0 Framework (Included in repository) <a href="http://www.codeigniter.com/">http://www.codeigniter.com/</a></li>
<li>MySQL 5 <a href="http://dev.mysql.com/">http://dev.mysql.com/</a></li>
<li>Apache2 <a href="http://www.apache.org">http://www.apache.org</a></li>
<li>JQuery <a href="http://www.jquery.org">http://www.jquery.org</a></li>
<li>JQuery Mobile <a href="http://jquerymobile.com/">http://jquerymobile.com/</a></li>
</ul>
</article>

</body>
</html>