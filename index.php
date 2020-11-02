<?php

interface FormConstructorInterface
{
    public function render(): string;
}

class FormConstructor implements FormConstructorInterface
{
    private $fields = [];

    
    public function __get($key)
    {
        if (!isset($this->fields[$key])) {
            return null;
        }
        return $this->fields[$key];
    }
    
    public function __set($key, $value)
    {
        $this->fields[$key] = $value;
    }


    public function render(): string
    {
        $formHtml = '<form>';
        foreach ($this->fields as $name => $value) {
            $formHtml .= sprintf(
                '<input type="text" name="%s" value="%s"/>',
                $name,
                $value
            );
        }
        $formHtml .= '</form>';
        
        return $formHtml;
    }
}

$formConstructor = new FormConstructor();

$formConstructor->first_name = 'Your first name';
$formConstructor->last_name = 'Your last name';
$formConstructor->email = 'Email address';
$formConstructor->address = 'Street address';

echo $formConstructor->render();



//<form>
//    <input type="text" name="propertyName" value="propertyValue"/>
//    ...
//    ...
//    ...
//    <input type="text" name="propertyNameN" value="propertyValueN"/>
//
//</form>
?>