<?php
namespace OCA\Raw\Controller;

trait RawResponse {
	protected function returnRawResponse($content, $mimetype) {
		// Ugly hack to prevent security middleware messing up the CSP.
		header(
			"Content-Security-Policy: sandbox; default-src 'none'; img-src data:; media-src data:; "
			. "style-src data: 'unsafe-inline'; font-src data:; frame-src data:"
		);
		header("Content-Type: ${mimetype}");
		echo $content;
		exit;
	}
}
