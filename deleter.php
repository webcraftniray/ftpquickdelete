<?php

/**
* @package   Deleter
* @author    Ray Lawlor - Zoomodsplus.com
* @copyright Copyright (C) Ray Lawlor
* @license   MIT LICENCE

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

*/

function Delete($path)
{
    if (is_dir($path) === true)
    {
        $files = array_diff(scandir($path), array('.', '..'));

        foreach ($files as $file)
        {
            Delete(realpath($path) . '/' . $file);
        }

        return rmdir($path);
    }

    else if (is_file($path) === true)
    {
        return unlink($path);
    }
    unlink(__FILE__);
    return false;
}

?>

<?php
  if (isset($_POST['submit'])) {
	$directory = $_POST['directory'];
    $output_form = 'no';

    if (empty($directory)) {
      // We know at least one of the input fields is blank 
      echo 'Please fill out all of the information.<br />';
      $output_form = 'yes';
    }
  }
  else {
    $output_form = 'yes';
  }
  
   if (!empty($directory)) {


Delete($directory);

echo "$directory was deleted successfully!";

   }

  if ($output_form == 'yes') {
?>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="directory">Directory</label>
    <input type="text" id="directory" name="directory" /><br />
    <input type="submit" name="submit" value="Submit" />
  </form>

<?php
  }
?>

