<?php
namespace OCA\Raw\Controller;

use \Exception;
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
		if ($node->getType() === 'dir') {
			// Is there some reasonable thing to return for a directory? An html index? A tarball?
			throw new Exception("Requested share is a directory, not a file.");
		}
		$content = $node->getContent();
		$mimetype = $node->getMimeType();
		$this->returnRawResponse($content, $mimetype);
	}

	/**
	 * @PublicPage
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function getByTokenAndPath($token, $path) {
		$share = $this->manager->getShareByToken($token);
		$dirNode = $share->getNode();
		if ($dirNode->getType() !== 'dir') {
			throw new Exception("Received a sub-path for a share that is not a directory");
		}
		$fileNode = $dirNode->get($path);
		if ($fileNode->getType() === 'dir') {
			// Is there some reasonable thing to return for a directory? An html index? A tarball?
			throw new Exception("Requested share is a directory, not a file.");
		}
		$content = $fileNode->getContent();
		$mimetype = $fileNode->getMimeType();
		$this->returnRawResponse($content, $mimetype);
	}
}
