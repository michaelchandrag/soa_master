<?php
require __DIR__ . '/vendor/autoload.php';

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Google Calendar API PHP Quickstart');
    $client->setScopes(Google_Service_Calendar::CALENDAR);
    $client->setAuthConfig('client_secret.json');
    $client->setAccessType('offline');
	$client->setRedirectUri('http://localhost/soa_master/quickstart.php');
    // Load previously authorized credentials from a file.
	if (isset($_GET['code'])) {
		echo $_GET['code'];
		$service = new Google_Service_Calendar($client);
		$authCode = $_GET["code"];
		$accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
		$client->setAccessToken($accessToken);
		// Print the next 10 events on the user's calendar.
		/*$calendarId = 'primary';
		$optParams = array(
		  'maxResults' => 10,
		  'orderBy' => 'startTime',
		  'singleEvents' => true,
		  'timeMin' => date('c'),
		);
		$results = $service->events->listEvents($calendarId, $optParams);
		if (empty($results->getItems())) {
			//print "No upcoming events found.\n";
		} else {
			//print "Upcoming events:\n";
			foreach ($results->getItems() as $event) {
				$start = $event->start->dateTime;
				if (empty($start)) {
					$start = $event->start->date;
				}
				//printf("%s (%s)\n", $event->getSummary(), $start);
			}
		}*/
		$event = new Google_Service_Calendar_Event(array(
		  'summary' => 'Google I/O 2015',
		  'location' => '800 Howard St., San Francisco, CA 94103',
		  'description' => 'A chance to hear more about Google\'s developer products.',
		  'start' => array(
			'dateTime' => '2018-07-12T09:00:00-07:00',
			'timeZone' => 'America/Los_Angeles',
		  ),
		  'end' => array(
			'dateTime' => '2018-07-13T17:00:00-07:00',
			'timeZone' => 'America/Los_Angeles',
		  ),
		  'recurrence' => array(
			'RRULE:FREQ=DAILY;COUNT=2'
		  ),
		  'attendees' => array(
			array('email' => 'lpage@example.com'),
			array('email' => 'sbrin@example.com'),
		  ),
		  'reminders' => array(
			'useDefault' => FALSE,
			'overrides' => array(
			  array('method' => 'email', 'minutes' => 24 * 60),
			  array('method' => 'popup', 'minutes' => 10),
			),
		  ),
		));

		$calendarId = 'primary';
		$event = $service->events->insert($calendarId, $event);
	} else {
		$authUrl = $client->createAuthUrl();
		header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
		// Fallback behaviour goes here
	}
    /*$credentialsPath = expandHomeDirectory('credentials.json');
    if (file_exists($credentialsPath)) {
        $accessToken = json_decode(file_get_contents($credentialsPath), true);
    } else {
        // Request authorization from the user.
        $authUrl = $client->createAuthUrl();
		header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
        //printf("Open the following link in your browser:\n%s\n", $authUrl);
        //print 'Enter verification code: ';
        $authCode = '4/AAAjZGGE5l-ImMS4G6ZoJG4kmmAdKqjltSCMdb120uhyPCJ0urgI9qM';

        // Exchange authorization code for an access token.
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

    }
    $client->setAccessToken($accessToken);*/

    // Refresh the token if it's expired.
    /*if ($client->isAccessTokenExpired()) {
        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
    }
    return $client;*/
}

/**
 * Expands the home directory alias '~' to the full path.
 * @param string $path the path to expand.
 * @return string the expanded path.
 */
function expandHomeDirectory($path)
{
    $homeDirectory = getenv('HOME');
    if (empty($homeDirectory)) {
        $homeDirectory = getenv('HOMEDRIVE') . getenv('HOMEPATH');
    }
    return str_replace('~', realpath($homeDirectory), $path);
}

// Get the API client and construct the service object.
$client = getClient();
//$service = new Google_Service_Calendar($client);

// Print the next 10 events on the user's calendar.
/*$calendarId = 'primary';
$optParams = array(
  'maxResults' => 10,
  'orderBy' => 'startTime',
  'singleEvents' => true,
  'timeMin' => date('c'),
);
$results = $service->events->listEvents($calendarId, $optParams);*/

