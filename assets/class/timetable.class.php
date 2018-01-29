<?php

/*
 * Timeline - for jQuery 1.3+
 * http://codecanyon.net/item/timetable-for-events-with-php-jquery-and-xml/546355?ref=RikdeVos
 *
 * Copyright 2012, Rik de Vos
 * You need to buy a license if you want use this script.
 * http://codecanyon.net/user/RikdeVos?ref=RikdeVos
 *
 * Version: 1.1 (Feb 13 2012)
 */

class Timetable {

	/**
	 * Timetable Settings
	 * @var array
	 */
	protected $settings = array('start' => 1000,
								'end' => 400,
								'interval' => 4,
								'number_times' => 17,
								'indicatorbar' => 'true',
								'title' => '',
								'prefix' => 12345,
								'width' => '100%',
								'print' => false,
								'quickprint' => false,
								'program' => false,
								'add_program_text' => 'Add to program',
								'remove_program_text' => 'Remove from program',
								'autoscroll' => false,
								'print_url' => 'print.php',
								'am_pm' => false
								);
	
	/**
	 * Timetable HTML output
	 * @var string
	 */
	protected $output = '';

	/**
	 * Constructor
	 */
	public function __construct() {

	}

	/**
	 * Creates a timetable from an XML url
	 * @param  string $url URL to XML
	 * @return null
	 */
	public function createTimetable($url) {

		//Load xml file
		$xml = @simplexml_load_file($url, NULL, LIBXML_NOCDATA);

		if(!$xml) {
			echo 'Error: there is an error in your XML file: <a href="'.$url.'">'.$url.'</a>';
			return;
		}

		if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0 || strpos($url, 'ftp://') === 0) {
			echo 'Error: the path to your xml file may not start with "http://"';
			return;
		}

		//Set the settings
		$this->setSettings($xml, $url);

		$this->writeHTML($xml);

		echo $this->mbencoding($this->output);
		return;

	}

	/**
	 * Parses YouTube links
	 * @param  string $id YouTube video id
	 * @return string
	 */
	protected function parseYouTube($id) {
	    $id = preg_replace('~
	        # Match non-linked youtube URL in the wild. (Rev:20110825)
	        https?://         # Required scheme. Either http or https.
	        (?:www\.)?        # Optional www subdomain.
	        (?:               # Group host alternatives.
	          youtu\.be/      # Either youtu.be,
	        | youtube\.com    # or youtube.com followed by
	          \S*             # Allow anything up to VIDEO_ID,
	          [^\w\-\s]       # but char before ID is non-ID char.
	        )                 # End host alternatives.
	        ([\w\-]{11})      # $1: VIDEO_ID is exactly 11 chars.
	        (?=[^\w\-]|$)     # Assert next char is non-ID or EOS.
	        (?!               # Assert URL is not pre-linked.
	          [?=&+%\w]*      # Allow URL (query) remainder.
	          (?:             # Group pre-linked alternatives.
	            [\'"][^<>]*>  # Either inside a start tag,
	          | </a>          # or inside <a> element text contents.
	          )               # End recognized pre-linked alts.
	        )                 # End negative lookahead assertion.
	        [?=&+%\w]*        # Consume any URL (query) remainder.
	        ~ix',
	        '$1',
	        $id);
	    return $id;
	}

	/**
	 * Parses stuff
	 * @param  string $text  Text
	 * @param  string $title Title
	 * @return string
	 */
	protected function parseLink($text, $title) {
	        $regex = array (
	            'find' => array (
	                '/(\s|^)([a-z_\-][a-z0-9\._\-]*@[a-z0-9_\-]+(\.[a-z0-9_\-]+)+)/si', // email like user.name@domain.tld
	                '/(\s|^)((?:https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/si', // links with: ftp http or https
	                '/(\s|^)(www.(?:[-A-Z0-9+&@#\/%?=~_|!:,.;]+)\.(?:[a-z]{2,4}))/si' // url's that begin with www.
	            ),
	            'replace' => array (
	                '\1<a class="tl_link" href="mailto:\2">\2<span class="tl_link_icon"></span></a>',
	                '\1<a class="tl_link" href="\2" title="\2" target="_blank">'.$title.'<span class="tl_link_icon"></span></a>',
	                '\1<a class="tl_link" href="http://\2" title="\2" target="_blank">'.$title.'<span class="tl_link_icon"></span></a>'
	            )
	        );

	        $text = preg_replace ($regex['find'], $regex['replace'], $text);
	    return $text;
	  }

	/**
	 * Writes the timetable HTML
	 * @param  object $xml XML object with timetable data
	 * @return null
	 */
	public function writeHTML($xml) {

		//Timeline wrapper
		$this->addHTMLLine('<div class="tl_container" style="width: '.$this->settings['width'].';">');


		if(!empty($this->settings['title'])) {
			$this->addHTMLLine('<p class="tl_timeline_title">'.$this->settings['title'].'</p>');
		}

		$this->addHTMLLine('<div '.(($this->settings['autoscroll'])?'data-autoscroll="true"' : 'data-autoscroll="false"').' class="tl_timeline" data-increment="'.$this->settings['interval'].'" data-hours="'.(($this->rangeTime($this->settings['start'], $this->settings['end']))/100).'" data-indicatorbar="'.$this->settings['indicatorbar'].'">');

        //Print button
        if($this->settings['print']) {
        	$quick = ($this->settings['quickprint'])?'true':'false';
	        $this->addHTMLLine('<div><a class="tl_print" rel="nofollow" data-printbox="'.$quick.'" target="_blank" href="'.$this->settings['print_url'].'?xml='.urlencode($this->settings['url']).'&amp;title='.urlencode($this->settings['title']).'&amp;pre='.$this->settings['prefix'].'" title="Print '.$this->settings['title'].'"></a></div>');
	    }

		//Time Selector Bar
		$this->addHTMLLine('<div class="tl_time_selector_bar"><ul>');

		$z = round($this->settings['start']/100);
		for($i = 0; $i <= round($this->settings['number_times']); $i++) {
			$this->addHTMLLine('<li>'.$this->format_time($z.':00').'</li>');
			$z++;
			if($z >= 24) { $z = 0; }
		}

		$this->addHTMLLine('</ul><div class="tl_clear">&nbsp;</div><div class="tl_slidable_slider"></div></div>');

		//Time Incicator
		$this->addHTMLLine('<div class="tl_time_indicator"><div class="tl_slidable"><ul>');

		if($this->settings['interval'] == 1) {

			$start = round($this->settings['start']/100)*100;
			$end = round($this->settings['end']/100)*100;
			if($end <= $start) {
				$end += 2400;
			}

			for($i = $start; $i <= $end; $i = $i+200) {

				$amount = (string) $i;

				if($amount >= 2400) {
					$amount -= 2400;
					$amount = (string) $amount;
				}

				if(strlen($amount) == 4) {
					$this->addHTMLLine('<li>'.$this->format_time($amount[0].$amount[1].':'.$amount[2].$amount[3]).'</li>');
				}elseif(strlen($amount) == 3) {
					$this->addHTMLLine('<li>'.$this->format_time($amount[0].':'.$amount[1].$amount[2]).'</li>');
				}


			}

		}else {
			$z = round($this->settings['start']/100);
			$m = ':00';
			for($i = 0; $i <= round($this->settings['number_times'])*2+1; $i++) {

				if($this->settings['interval'] == 2) {
					$m = ':00';
					if($i%2 == 0) {
						continue;
					}
				}
				$this->addHTMLLine('<li>'.$this->format_time($z.$m).'</li>');

				if($m == ':00') {
					$m = ':30';
				}else {
					$m = ':00';
					$z++;
				}
				if($z >= 24) { $z = 0; }
				if($this->settings['interval'] == 2) {
					$z++;
				}
			}
		}

		$eventid = 0;

		$this->addHTMLLine('</ul><div class="tl_clear">&nbsp;</div></div></div>');

		//Next and previous buttons
		$this->addHTMLLine('<a class="tl_next" href="#"></a><a class="tl_previous" href="#"></a>');

		//Foreach location
		$i = 0;
		$j = 0;
		foreach($xml->location as $location) {
			$i++;
			$event_details = array('');

			$attr = $location->attributes();

			$this->addHTMLLine('<div class="tl_location">');
			$this->addHTMLLine('<div class="tl_the_location" data-location="'.$i.'">');
			$this->addHTMLLine('<h3>'.(string) $attr['name'].'</h3>');
			$this->addHTMLLine('<p class="tl_the_location_subtitle">'.(string) $attr['subtext'].'</p>');
			$this->addHTMLLine('</div><div class="tl_the_timeline"><div class="tl_the_timeline_content tl_slidable">');


			//Foreach event
			foreach($location->event as $event) {
				$j++;
				$eventid++;

				$attr = $event->attributes();
				$start = $this->convertToTime((string) $attr['start']);
				$end = $this->convertToTime((string) $attr['end']);

				$begin = $this->rangeTime($this->settings['start'], $start) * $this->settings['interval']/2;
				$length = $this->rangeTime($start, $end) * $this->settings['interval']/2;

				$show_description = (empty($event->description)) ? 'data-show-description="false" ' : 'data-show-description="true" ';

				$this->addHTMLLine('<div '.$show_description.'class="tl_event" data-eventid="'.$eventid.'" data-event="'.$j.'" style="left: '.$begin.'px; width: '.($length-3).'px;" data-location="'.$i.'">');
				$this->addHTMLLine('<span class="tl_event_time">'.$this->format_time((string) $attr['start']).' - '.$this->format_time((string) $attr['end']).'</span>');
				$this->addHTMLLine('<h2>'.$event->title.'</h2>');
				$this->addHTMLLine('<p class="tl_subtitle">'.$event->subtitle.'</p>');
				$this->addHTMLLine('<div class="tl_event_program_indicator"></div>');
				$this->addHTMLLine('</div>');

				$str = '<div class="tl_event_details" data-start="'.(string) $attr['start'].'" data-event="'.$j.'">';

				if(!empty($event->image)) { $str .= '<a href="'.$event->image.'" class="tl_event_image" title="'.$event->title.'"><img alt="'.$event->title.'" src="'.$event->image.'"></a>'; }
				if(!empty($event->youtube)) { $str .= '

                    <a data-group="youtube" class="youtube" href="http://www.youtube.com/embed/'.$this->parseYouTube($event->youtube).'?wmode=transparent&amp;showsearch=0&amp;version=3&amp;iv_load_policy=3&amp;showinfo=1&amp;rel=0&amp;autoplay=1&amp;theme=light&amp;color=red&amp;modestbranding=1">
                    <img src="http://img.youtube.com/vi/'.$this->parseYouTube($event->youtube).'/2.jpg" class="youtubethumb" alt="" width="130" height="97">
                    </a>

				'; }
				$str .= $event->description;

				$str .= '<div class="tl_description_bottom">';

				if(!empty($event->link)) {
					$linkattr = $event->link->attributes();
					$linktitle = (string) $linkattr['text'];
					if(empty($linktitle)) {
						$linktitle = $event->title;
					}

					$str .= $this->parseLink($event->link, $linktitle);
				}

				if($this->settings['program']) {
					$str .= '<a href="#" data-eventid="'.$eventid.'" data-add-text="'.$this->settings['add_program_text'].'" data-prefix="'.$this->settings['prefix'].'" data-remove-text="'.$this->settings['remove_program_text'].'" data-event="'.$j.'" data-start="'.urlencode((string) $attr['start']).'" class="tl_program_button" data-val="false">'.$this->settings['add_program_text'].'</a>';
				}
				$str .= '</div>';

				$str .= '<div class="tl_clear">&nbsp;</div></div>';

				array_push($event_details, $str);
			}

			$this->addHTMLLine('</div>');

			foreach($event_details as $eve) {
				$this->addHTMLLine($eve);
			}

			$this->addHTMLLine('</div><div class="tl_clear">&nbsp;</div></div>');
		}

		//Close Timeline div
		$this->addHTMLLine('</div>');


		//Close timeline wrapper
		$this->addHTMLLine('</div>');

	}

	/**
	 * Sets the XML settings
	 * @param string $xml XML
	 * @param string $url XML url
	 * @return null
	 */
	public function setSettings($xml, $url) {

		//Update settings from xml
		$this->updateXMLSettings($xml);

		//Set xml url
		$this->settings['url'] = $url;

		//Set number_times
		$this->settings['number_times'] = $this->rangeTime($this->settings['start'], $this->settings['end'])/100;

		//Set timetable prefix
		$this->settings['prefix'] = md5($url.'5a1t');

		//Set title
		if(!empty($title)) {
			$this->settings['title'] = $title;
		}

		//Set width
		if (!empty($width)) {

			//If percentage
			if ($width[strlen($width)-1] == '%') {
				$this->settings['width'] = $width;

			//If 'px'
			}elseif ($width[strlen($width)-1] == 'x') {
				$this->settings['width'] = $width;

			//Else, an integer
			}else {
				$this->settings['width'] = $width.'px';
			}
		}
	}

	/**
	 * Sets the timetable title
	 * @param string $title Value
	 * @return null
	 */
	public function setTimetableTitle($title) {
		if(!empty($title)) {
			$this->settings['title'] = $title;
		}
	}

	/**
	 * Sets the timetable autoscroll
	 * @param mixed $val Value
	 * @return null
	 */
	public function setTimetableAutoscroll($val = 'em') {
		if($val == 'em') {
			$this->settings['autoscroll'] = true;
		}else {
			$this->settings['autoscroll'] = $val;
		}

	}

	/**
	 * Sets the timetable width
	 * @param int $width Value
	 * @return null
	 */
	public function setTimetableWidth($width) {
		//Set width
		if (!empty($width)) {

			//If percentage
			if ($width[strlen($width)-1] == '%') {
				$this->settings['width'] = $width;

			//If 'px'
			}elseif ($width[strlen($width)-1] == 'x') {
				$this->settings['width'] = $width;

			//Else, an integer
			}else {
				$this->settings['width'] = $width.'px';
			}
		}
	}

	/**
	 * Sets the timetable print
	 * @param mixed $quick Value
	 * @return null
	 */
	public function setTimetablePrint($quick = 'em') {
		if($quick !== 'em') { $this->settings['quickprint'] = $quick; }
		$this->settings['print'] = true;
	}

	/**
	 * Sets the timetable program text
	 * @param mixed $add    Add text
	 * @param mixed $remove Remove text
	 * @return null
	 */
	public function setTimetableProgram($add = false, $remove = false) {
		$this->settings['program'] = true;
		if(!empty($add)) {
			$this->settings['add_program_text'] = $add;
		}
		if(!empty($remove)) {
			$this->settings['remove_program_text'] = $remove;
		}
	}

	/**
	 * Sets the indicator bar
	 * @param boolean $val value
	 * @return null
	 */
	public function setTimetableIndicatorBar($val) {
		if($val == true) {
			$this->settings['indicatorbar'] = 'true';
		}else {
			$this->settings['indicatorbar'] = 'false';
		}

	}

	/**
	 * Sets the time format
	 * @param int $val Time format. 12 | 24
	 */
	public function setTimetableTimeFormat($val = 12) {
		if($val === 24) {
			$this->settings['am_pm'] = false;
		}else {
			$this->settings['am_pm'] = true;
		}
	}

	/**
	 * Returns the time between 2 times
	 * @param  int $a First time
	 * @param  int $b Second time
	 * @return int
	 */
	public function rangeTime($a, $b) {
		$out = $b-$a;
		if($out < 0) {
			$out += 2400;
		}
		return $out;

	}

	/**
	 * Converts time to an integer
	 * @param  string $time Time to convert
	 * @return int
	 */
	public function convertToTime($time) {
		if($time[0] == '0') {
			$time = substr($time, 1);
		}

		$times = preg_split('/:/', $time);
		return $times[0]*100 + $times[1]*(5/3);
	}

	/**
	 * Formats the time in 24:00 or 12:00 format
	 * @param  string $time Time to format
	 * @return string
	 */
	public function format_time($time) {
		if(!$this->settings['am_pm']) {
			return $time;
		}

		$times = preg_split('/:/', $time);

		$hour = 'am';
		if($times[0] >= 13 && $times[0] < 24) {
			$hour = 'pm';
			$times[0] = $times[0] - 12;
		}

		return $times[0].':'.$times[1].$hour;

	}

	/**
	 * Saves the XML settings in the settings of the script
	 * @param  string $xml XML with settings
	 * @return null
	 */
	public function updateXMLSettings($xml) {
		//Update default settings
		$attributes = $xml->attributes();

		if(!empty($attributes['start'])) {
			$start = (string) $attributes['start'];
			$this->settings['start'] = $this->convertToTime($start);
		}
		if(!empty($attributes['end'])) {
			$this->settings['end'] = $this->convertToTime((string) $attributes['end']);
		}
		if(!empty($attributes['interval'])) {
			$this->settings['interval'] = (string) $attributes['interval'];
		}
		if(!empty($attributes['title']) && empty($this->settings['title'])) {
			$this->settings['title'] = (string) $attributes['title'];
		}

	}

	/**
	 * Adds a line of HTML to the output
	 * @param string $line HTML to add
	 * @return null
	 */
	public function addHTMLLine($line) {
		$this->output .= $line;
	}

	/**
	 * Encodes the HTML
	 * @param  string $string HTML to encode
	 * @return string
	 */
	protected function mbencoding($string) {
		if (function_exists('mb_convert_encoding')) {
			return mb_convert_encoding($string, 'HTML-ENTITIES', 'UTF-8');
		}else {
			return htmlentities(utf8_encode($string));
		}
	}
}
?>