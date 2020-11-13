

<script async src='https://www.googletagmanager.com/gtag/js?id=`+data.googletag+`'></script>

<script>

window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', '`+data.googletag+`');

</script>

<script>

	var grecaptchaTest;
	var onloadCallback = function() {
		grecaptcha.render('test-recaptcha', {
			'sitekey' : '`+data.gcap+`'
		});
		grecaptchaTest = grecaptcha;
	};

	function isCaptchaChecked() {
		return grecaptchaTest && grecaptchaTest.getResponse().length !== 0;
	}

</script>

<script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=`+lang+`'
async defer></script>
