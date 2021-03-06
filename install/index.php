<?php
/*
 *   Copyright 2008-2012 Maarch
 *
 *   This file is part of Maarch Framework.
 *
 *   Maarch Framework is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   Maarch Framework is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with Maarch Framework. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * @brief front script for install
 *
 * @file
 * @author Arnaud Veber
 * @date $date$
 * @version $Revision$
 * @ingroup install
 */

/* ---------------------------------------------------------------------------*-
  * MODEL
-*--------------------------------------------------------------------------- */
    // use init.php from core
    require_once '../core/init.php';
    
    // require Install class & instantiate an Install Object
    require_once('install/class/Class_Install.php');
    $Class_Install = new Install;

/* ---------------------------------------------------------------------------*-
  * CONTORLLER
-*--------------------------------------------------------------------------- */
    // get step
    if (!isset($_REQUEST['step']) || empty($_REQUEST['step']))
        if (isset($_SESSION['inInstall']))
            exit(header("Location: error.php?error=noStep"));
    $step = (!empty($_REQUEST['step'])) ? $_REQUEST['step'] : 'language';
    
    // check step
    if (!file_exists('install/controller/'.$step.'_controller.php'))
        exit(header("Location: error.php?error=badStep"));
    
    // save step
    $Class_Install->setPreviousStep($step);
    
    // use step controller
    require_once('install/controller/'.$step.'_controller.php');

/* ---------------------------------------------------------------------------*-
  * VIEW
-*--------------------------------------------------------------------------- */
    // use view
    require_once('install/view/principal_view.php');