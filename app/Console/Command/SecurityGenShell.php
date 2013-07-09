<?php
/* SecurityGenShell - prints randmom Security.salt and Security.cipherSeed for
 * Config/core.php
 *
 * See lib/Cake/Console/Command/Task/ProjectTask.php securitySalt() and
 * securityCipherSeed().
 *
 * Installation: put this file, named `SecurityGenShell.php`, in `APP/Console/Command`.
 * Usage: run `Console/cake security_gen` - copy and pasted the values to
 * APP/Config/core.php.
 */
App::uses('Security', 'Utility');

class SecurityGenShell extends AppShell {

	public function main() {
		$this->stdout->styles('red', array('text' => 'red'));

		$securitySalt = Security::generateAuthKey();
		$this->out('Security.salt: <red>' . $securitySalt . '</red>');

		$securityCipherSeed = substr(bin2hex(Security::generateAuthKey()), 0, 30);
		$this->out('Security.cipherSeed: <red>' . $securityCipherSeed . '</red>');
	}
}