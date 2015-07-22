## Oauth Client for Client Credentials Grant Types.  
Written to consume Impactflow Internal Oauth Server.

## Usage example

### Get Token
```
$tokenRequest = new \ImpactOauthClient\TokenRequest('TestClient', 'TestSecret');
$tokenRequest->setUri('https://oauth-provider/token');
$oauthClient = new ImpactOauthClient\Client(new GuzzleHttp\Client(['verify' => false]));
$token = $oauthClient->requestToken($tokenRequest);
```
### Validate
```
$resourceRequest = new \ImpactOauthClient\ResourceRequest();
$resourceRequest->setAccessToken('MyLongToken');
$token= $oauthClient->validateToken($resoureRequest);
```
