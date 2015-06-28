# Drug Search RESTFul Interface and Sample HTML5 Mobile Application
##Prototype URLS
###Responsive HTML Sample Prototype
http://rfq993471.technicate.com/RFQ993471/sample_mobile_frontend
###Web Service Endpoint
http://rfq993471.technicate.com/RFQ993471/index.php/FDARequest/drugsearch/zantac

##Description
Technicate Solution's Drug Search is written in PHP5 and the CodeIgnitor 3.0 MVC based framework.  
The web service endpoint serves as a prototype platform for connecting to the http://open.fda.gov API and datasets to pull single descriptions of medications based on a generic or brand name openfda search term.  It includes a sample MySQL database schema to cache these results coming from the FDA into.  This would minimize the amount of requests set to an external system, such as open.fda.gov.  
This application can be easily served on a cloud VPS using a standard Linux, Apache2, PHP5 and MySQL instance.  It includes a sample responsive HTML based web site and mobile site, written using JQuery and JQuery Mobile, as an example application that would use this caching system. 
##Technologies Required


