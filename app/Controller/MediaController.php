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
namespace Fisharebest\Webtrees\Controller;

use Fisharebest\Webtrees\Auth;
use Fisharebest\Webtrees\Fact;
use Fisharebest\Webtrees\Filter;
use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\Menu;
use Fisharebest\Webtrees\Module;

/**
 * Controller for the media page
 */
class MediaController extends GedcomRecordController {
	/**
	 * get edit menu
	 */
	public function getEditMenu() {
		if (!$this->record || $this->record->isPendingDeletion()) {
			return null;
		}

		// edit menu
		$menu = new Menu(I18N::translate('Edit'), '#', 'menu-obje');

		if (Auth::isEditor($this->record->getTree())) {
			// main link displayed on page
			if (Module::getModuleByName('GEDFact_assistant')) {
				$menu->addSubmenu(new Menu(I18N::translate('Manage the links'), '#', 'menu-obje-link', [
					'onclick' => 'return ilinkitem("' . $this->record->getXref() . '","manage");',
				]));
			} else {
				$menu->addSubmenu(new Menu(I18N::translate('Link this media object to an individual'), '#', 'menu-obje-link-indi', [
					'onclick' => 'return ilinkitem("' . $this->record->getXref() . '","person");',
				]));

				$menu->addSubmenu(new Menu(I18N::translate('Link this media object to a family'), '#', 'menu-obje-link-fam', [
					'onclick' => 'return ilinkitem("' . $this->record->getXref() . '","family");',
				]));

				$menu->addSubmenu(new Menu(I18N::translate('Link this media object to a source'), '#', 'menu-obje-link-sour', [
					'onclick' => 'return ilinkitem("' . $this->record->getXref() . '","source");',
				]));
			}

			// delete
			$menu->addSubmenu(new Menu(I18N::translate('Delete'), '#', 'menu-obje-del', [
				'onclick' => 'return delete_record("' . I18N::translate('Are you sure you want to delete “%s”?', strip_tags($this->record->getFullName())) . '", "' . $this->record->getXref() . '");',
			]));
		}

		// edit raw
		if (Auth::isAdmin() || Auth::isEditor($this->record->getTree()) && $this->record->getTree()->getPreference('SHOW_GEDCOM_RECORD')) {
			$menu->addSubmenu(new Menu(I18N::translate('Edit the raw GEDCOM'), 'edit_interface.php?action=editraw&amp;ged=' . $this->record->getTree()->getNameHtml() . '&amp;xref=' . $this->record->getXref(), 'menu-obje-editraw'));
		}

		return $menu;
	}

	/**
	 * Return a list of facts
	 *
	 * @return Fact[]
	 */
	public function getFacts() {
		return $this->record->getFacts(null, true);
	}
}
