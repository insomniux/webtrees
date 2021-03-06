<?php
/**
 * webtrees: online genealogy
 * Copyright (C) 2017 webtrees development team
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

use Fisharebest\Webtrees\Html;

/**
 * Dump the passed variables and end the script.
 *
 * @param  mixed
 *
 * @return void
 */
function dd(...$args): void
{
	foreach ($args as $x) {
		var_dump($x);
	}

	die(1);
}

/**
 * Generate a URL for a named route.
 *
 * @param string $route
 * @param array  $parameters
 *
 * @return string
 */
function route(string $route, array $parameters = []): string {
	$parameters = ['route' => $route] + $parameters;

	return Html::url('index.php', $parameters);
}
