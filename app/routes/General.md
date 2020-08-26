## General information

WBC REST API is a one of fundamental part of general product architecture.

To use a REST API, an application makes an HTTP request to the WBC server and parses the response.

For testing recommend the use Postman App or <a href="https://chrome.google.com/webstore/detail/advanced-rest-client/hgmloofddffdnphfgcellkdfbfbjeloo" target="_blank">Google Chrome plugin</a>.<br>Also you can use "Send a Sample Request" block from this documentation document if it available on context.


## REST Authentication

In the current implementation, data is transmitted exceptionally by the presence of a token, so you must be already registered.<br>For token pass authorization, using the method auth/register.