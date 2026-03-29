<?php

class Router
{
    private $routes = [];

    public function get($uri, $action)
    {
        $this->addRoute('GET', $uri, $action);
    }

    public function post($uri, $action)
    {
        $this->addRoute('POST', $uri, $action);
    }

    public function put($uri, $action)
    {
        $this->addRoute('PUT', $uri, $action);
    }

    public function delete($uri, $action)
    {
        $this->addRoute('DELETE', $uri, $action);
    }

    private function addRoute($method, $uri, $action)
    {
        // Convertir {param} en regex ( [^/]+ )
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $uri);
        $pattern = "#^" . $pattern . "$#";

        $this->routes[$method][$pattern] = $action;
    }

    public function resolve($uri, $method)
    {
        foreach ($this->routes[$method] ?? [] as $pattern => $action) {
            if (preg_match($pattern, $uri, $matches)) {
                // Filter named captures for parameters
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                return $this->dispatch($action, $params);
            }
        }

        http_response_code(404);
        echo "<h1>404 - Page Not Found</h1>";
        echo "<p>The route <strong>$uri</strong> does not exist.</p>";
    }

    private function dispatch($action, $params)
    {
        if ($action instanceof Closure) {
            return call_user_func_array($action, array_values($params));
        }

        if (is_string($action) && strpos($action, '@')) {
            [$controller, $method] = explode('@', $action);
            $controller = "App\\Controllers\\$controller";

            if (class_exists($controller)) {
                $controllerInstance = new $controller();
                if (method_exists($controllerInstance, $method)) {
                    return call_user_func_array([$controllerInstance, $method], array_values($params));
                }
                die("The method $method does not exist in $controller");
            }
            die("The controller $controller does not exist.");
        }

        die("Invalid route format.");
    }
}

