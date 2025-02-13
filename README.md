I have completed the technical test. The approach I have taken is using API routes to encode (shorten) and decode (show original) urls. In my controller method I have opted to cache the data for 30 days - We could alternatively run a migration to create a database table and store these urls in the model if we wish to. 

In addition to the above implementation I have written tests which test the functionality of my code. 

Instruction:

<ul>
    <li>Clone the repository on your machine</li>
    <li>I have included a file in the root directory called ‘.env.mohsin’ just copy and paste the content of this file into your ‘.env’ file</li>
    <li>In a terminal window navigate to the root directory of the project</li>
    <li>Run the command ‘php artisan serve’</li>
</ul>

Run the following command to shorten a URL:
<ul>
    <li>curl -X POST http://127.0.0.1:8000/api/encode -H "Content-Type: application/json" -d '{"url": "https://www.thisisalongdomain.com/with/some/parameters?and=here_too"}'</li>
</ul>



Run the following command to show the original URL (replace ‘short-url’ with your shortened url from the previous command) 
<ul>
    <li>curl -X POST http://127.0.0.1:8000/api/decode -H "Content-Type: application/json" -d '{"short_url": "short-url"}'</li>
</ul>



You can run the automated tests by running the following command:
<ul>
    <li>Php artisan test</li>
</ul>

<p>If you have any question or feedback pelase feel free to get in touch.</p>

<p>I look forwards to hearing back from you, <br />
Mohsin.</p>
