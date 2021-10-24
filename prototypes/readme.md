# Prototypes for testing the APIs

We decided to use HERE's APIs, and here we create some small test projects to test the capabilities of these APIs.

## Weather API Test

In the weather API test app (`weather` folder) we test the capabilities of HERE's Destination Weather API.
The test project is capable to gather current weather information based on:
+ GPS location (Right here button)
+ City name

## Traffic API Test

In the traffic API test app (`traffic` folder) we test the capabilities of multiple HERE APIs (Routing, Geolocation, Public Transit, Maps).

### How to use:

1. Set source (from) or use GPS
2. Set destination (to)
3. Hit GO!
Please note, that most of the desktop devices does not have a GPS sensor. In this case the measures can be inaccurate

### Results:

+ The state of traffic (very low / low / medium / high / very high)
+ Fastest car route, its length and duration
+ Fastest bike route, its length and duration
+ Fastest pubic transit route, its length and duration (if there is any)


## API key

In `apiConnection.js` we store our API key. This is a sensitive and abusable information, so we do not publish it here, in this public repo.
If you want an API key, to test our apps please contact us, or register to https://developer.here.com/
