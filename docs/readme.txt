MVC

Place your model and controller classes in the respective directories
with the same name as the file name (minus the .php extension).
Place the view within the view directory.

Controllers have to extend the Controller class.
$this->loadModel('model_name') loads a model object into an object
property with the model name.
$this->loadView('view_name', $data) renders the view with the
specified data