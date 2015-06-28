# Drug Search RESTFul Interface and Sample HTML5 Mobile Application
##Prototype URLS
###Responsive HTML Sample Prototype
http://rfq993471.technicate.com/RFQ993471/sample_mobile_frontend
###Web Service Endpoint (JSONP Callback output)
http://rfq993471.technicate.com/RFQ993471/index.php/FDARequest/drugsearch/zantac

##Description
Technicate used the human centered approach of inspiration, idea & implementation to develop this application.  We interviewed employees and others, 5 subjects, on the usefulness of a mobile or web application that provided all of the data the FDA has on a specific drug.  The feedback was very positive, such as, using it to find out proper dosage or warnings of medications prescribed.  Ideas included reading directions in the middle of the night without having to "fumble for them".  As a result, we had an idea phase (screenshots included) where we chose our technical approach (below) and implementation team.

Technicate Solution's Drug Search is written in PHP5 and the CodeIgnitor 3.0 MVC based framework.  
The web service endpoint serves as a prototype platform for connecting to the http://open.fda.gov API and datasets to pull single descriptions of medications based on a generic or brand name openfda search term.  It includes a sample MySQL database schema to cache these results coming from the FDA into.  This would minimize the amount of requests set to an external system, such as open.fda.gov.  

This application can be easily served on a cloud VPS using a standard Linux, Apache2, PHP5 and MySQL (LAMP) instance.  It includes a sample responsive HTML based web site and mobile site, written using JQuery and JQuery Mobile, as an example application that would use this caching system. 
##Development and Database Technologies Used
- PHP5 http://www.php.net
- CodeIgnitor 3.0 Framework (Included in repository) http://www.codeigniter.com/
- MySQL 5 http://dev.mysql.com/
- Apache2 http://www.apache.org
- JQuery http://www.jquery.org
- JQuery Mobile http://jquerymobile.com/


