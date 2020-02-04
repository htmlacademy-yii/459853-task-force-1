<?php

namespace frontend\helpers;

class TemplateForm
{

    public static function getTemplateCheckbox($label, $value, $name, $checked)
    {
        $checkedVal =  $checked ? 'checked': '';

        return "<input 
                    class='visually-hidden checkbox__input' 
                    id='{$value}' 
                    type='checkbox' 
                    name='{$name}' 
                    value='{$value}'
                    {$checkedVal}>
                <label for='{$value}'>{$label}</label>";
    }

}