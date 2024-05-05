# <img src="https://raw.githubusercontent.com/Digital-Media/fhooe-router-skeleton/076902786d9e13145b315154b0ea30b6222e3055/views/images/fhooe-router-logo.svg" height="32" alt="The fhooe/router-skeleton Logo: Three containers arrows going in different directions: left, up, and right."> fhooe/router-skeleton

An example application, a.k.a. skeleton for getting started with [*fhooe/router*](https://github.com/Digital-Media/fhooe-router): the simple object-oriented router developed for PHP classes in the [Media Technology and Design](https://www.fh-ooe.at/en/hagenberg-campus/studiengaenge/bachelor/media-technology-and-design/) program at the [University of Applied Sciences Upper Austria](https://www.fh-ooe.at/en/hagenberg-campus/). This skeleton and the library behind it are primarily designed for educational purposes (learning the concept of routing and object-oriented principles). Use it for "public" applications at your own risk.

## Creating a *fhooe/router* Application

Use Composer to create a new project containing the skeleton files:

```bash
composer create-project fhooe/fhooe-router-skeleton path/to/install
```

Composer will create a project in the specified `path/to/install` directory.

## Basic Usage

The router invocation happens in `public/index.php`. This front controller file receives all the requests since the associated `.htaccess` file will redirect everything to it.

*fhooe/router* can be used in two ways:

### Using a `Router` Object (recommended)

1. Instantiate the `Router` class.

   ```php
   $router = new Router();
   ```

2. Define routes using the `get()` and `post()` methods. Supply a URI pattern to match against and a callback that is executed when the pattern and protocol match.

   ```php
   $router->get("/", function() {
       // e.g., load a view
   });
   ```

3. Set a 404 callback to load a view or trigger behavior when no route matches.

   ```php
   $router->set404Callback(function() {
       // e.g., load a 404 view
   });
   ```

4. Optional: define a base path if your application is not located in your server's document root. 

   ```php
   $router->setBasePath("/path/to/your/files");
   ```

5. Run the router. This will fetch the current URI, match it against the defined routes, and execute them if a match is found.

   ```php
   $router->run();
   ```

### Using the Static Routing Method `Router::getRoute()`

1. Invoke the static method. Provide a base path as an argument if your project is not located in your server's document root. The method returns the route as a string in the form of `PROTOCOL /pattern` , e.g., `GET /`, when a GET request was made to the root directory.

   ```php
   $route = Router::getRoute("/path/to/your/files");
   ```

2. Use a conditional expression to decide what to do with the matched route.

   ```php
   switch($route) {
       case "GET /":
           // e.g., load a view
           break;
       default:
           // e.g., load the 404 view
           break;
   }
   ```

## Displaying Output

Simple example view files in the form of HTML and PHP files are located in the `views` directory together with [Twig](https://packagist.org/packages/twig/twig) examples for cleaner output.

Three Twig extensions have been added.

- `RouterExtension` provides the functions `url_for()` and `get_base_path()` in templates for generating URLs and retrieving the base path from the `Router` object.
- `SessionExtension` provides the function `session(key)` for retrieving entries in the `$_SESSION` superglobal.
- `DebugExtension` provides the function `dump()` for dumping variables in templates (similar to `var_dump()`).

## Browsing the Application

For taking a quick look, you can use the PHP built-in web server:

    cd path/to/install
    composer start

Navigate to <http://localhost:8888/> in your browser to see the application in action.

## Contributing

If you'd like to contribute, please refer to [CONTRIBUTING](https://github.com/Digital-Media/fhooe-router-skeleton/blob/main/CONTRIBUTING.md) for details.

## License

*fhooe/router-skeleton* is licensed under the MIT license. See [LICENSE](https://github.com/Digital-Media/fhooe-router-skeleton/blob/main/LICENSE) for more information.
