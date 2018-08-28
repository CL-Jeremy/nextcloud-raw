<?php
namespace OCA\Raw\Controller;

use OCP\IRequest;
use OCP\Share\IManager;
use OCP\AppFramework\Controller;
use OCP\Files\Folder;

class PubPageController extends Controller {
	use RawResponse;

	private $manager;

	public function __construct(
		$AppName,
		IRequest $request,
		IManager $shareManager
	) {
		parent::__construct($AppName, $request);
		$this->manager = $shareManager;
	}

	/**
	 * @PublicPage
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function getByToken($token) {
		$share = $this->manager->getShareByToken($token);
		$node = $share->getNode();
		// if ($node->getType() === 'dir') { TODO }
		$content = $node->getContent();
		$mimetype = $node->getMimeType();
		$this->returnRawResponse($content, $mimetype);
	}
}
