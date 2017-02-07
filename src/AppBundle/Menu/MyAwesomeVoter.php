<?php


namespace AppBundle\Menu;


use Knp\Menu\ItemInterface;
use Knp\Menu\Matcher\Voter\VoterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @author Arthur Gribet <a.gribet@gmail.com>
 */
class MyAwesomeVoter implements VoterInterface
{

	/**
	 * @var Request
	 */
	private $request;

	/**
	 * MyAwesomeVoter constructor.
	 * @param RequestStack|null $request
	 */
	public function __construct(RequestStack $request = null)
	{
		$this->request = $request->getCurrentRequest();
	}

	/**
	 * @param Request $request
	 */
	public function setRequest(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * @param ItemInterface $item
	 * @return bool|null
	 */
	public function matchItem(ItemInterface $item)
	{
		if (null === $this->request) {
			return null;
		}

		$route = $this->request->attributes->get('_route');
		if (null === $route) {
			return null;
		}

		$routes = (array)$item->getExtra('routes', []);

		foreach ($routes as $testedRoute) {
			if (is_string($testedRoute)) {
				$testedRoute = ['route' => $testedRoute];
			}

			if (!is_array($testedRoute)) {
				throw new \InvalidArgumentException('Routes extra items must be strings or arrays.');
			}

			if ($this->isMatchingRoute($testedRoute)) {
				return true;
			}
		}

		return null;
	}

	/**
	 * @param array $testedRoute
	 * @return bool
	 */
	private function isMatchingRoute(array $testedRoute)
	{
		$route = $this->request->attributes->get('_route');

		if (isset($testedRoute['route'])) {
			if (strpos($route, $testedRoute['route']) === false) {
				return false;
			}
		} elseif (!empty($testedRoute['pattern'])) {
			if (!preg_match($testedRoute['pattern'], $route)) {
				return false;
			}
		} else {
			throw new \InvalidArgumentException('Routes extra items must have a "route" or "pattern" key.');
		}

		if (!isset($testedRoute['parameters'])) {
			return true;
		}

		$routeParameters = $this->request->attributes->get('_route_params', []);

		foreach ($testedRoute['parameters'] as $name => $value) {
			if (!isset($routeParameters[$name]) || $routeParameters[$name] !== (string)$value) {
				return false;
			}
		}

		return true;
	}
}
