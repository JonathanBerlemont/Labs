<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpdateContact extends Controller
{
    protected function setEnvironmentValue(array $values)
    {

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {

                $str .= "\n"; // In case the searched variable is in the last line without \n
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }

            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) return false;
        return true;

    }

    public function update()
    {
        $attributes = request()->validate([
            'description' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ]);

        $this->setEnvironmentValue(['CONTACT_DESCRIPTION' => '"' . $attributes['description'] . '"']);
        $this->setEnvironmentValue(['CONTACT_ADDRESS' => '"' . $attributes['address'] . '"']);
        $this->setEnvironmentValue(['CONTACT_PHONE' => '"' . $attributes['phone'] . '"']);
        $this->setEnvironmentValue(['CONTACT_MAIL' => '"' . $attributes['email'] . '"']);

        return back()->with('success', 'Data updated');
    }    
}