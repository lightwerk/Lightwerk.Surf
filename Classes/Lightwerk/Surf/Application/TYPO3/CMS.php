<?php
namespace Lightwerk\Surf\Application\TYPO3;

use TYPO3\Surf\Domain\Model\Workflow;
use TYPO3\Surf\Domain\Model\Deployment;

/**
 * A TYPO3 CMS application template
 * @TYPO3\Flow\Annotations\Proxy(false)
 */
class CMS extends \TYPO3\Surf\Application\BaseApplication {

	/**
	 * The production context
	 * @var string
	 */
	protected $context = 'Production';

	/**
	 * Constructor
	 *
	 * @param string $name
	 */
	public function __construct($name = 'LW TYPO3 CMS') {
		parent::__construct($name);
	}

	/**
	 * Register tasks for this application
	 *
	 * @param \TYPO3\Surf\Domain\Model\Workflow $workflow
	 * @param \TYPO3\Surf\Domain\Model\Deployment $deployment
	 * @return void
	 */
	public function registerTasks(Workflow $workflow, Deployment $deployment) {
		parent::registerTasks($workflow, $deployment);

		$workflow->setTaskOptions('typo3.surf:cleanupreleases', array('keepReleases' => 2));

		$workflow
			->addTask('lightwerk.surf:typo3:cms:createuploadfolders', 'cleanup', $this)
			->addTask('lightwerk.surf:typo3:cms:updatedb', 'cleanup', $this)
			->addTask('lightwerk.surf:typo3:cms:clearcache', 'cleanup', $this);

	}

	/**
	 * Set the application production context
	 *
	 * @param string $context
	 */
	public function setContext($context) {
		$this->context = trim($context);
		return $this;
	}

	/**
	 * Get the application production context
	 *
	 * @return string
	 */
	public function getContext() {
		return $this->context;
	}

}
?>