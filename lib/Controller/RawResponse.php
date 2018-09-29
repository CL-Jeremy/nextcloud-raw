<?php
namespace OCA\Raw\Controller;

use \Exception;

trait RawResponse {
	protected function returnRawResponse($fileNode) {
		if ($fileNode->getType() === 'dir') {
			// Is there some reasonable thing to return for a directory? An html index? A tarball?
			throw new Exception("Requested share is a directory, not a file.");
		}

		$content = $fileNode->getContent();
		$mimetype = $fileNode->getMimeType();

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
