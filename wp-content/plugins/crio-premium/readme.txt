=== Crio Premium ===
Contributors: boldgrid, imh_brad, joemoto, rramo012, timph, jamesros161
Tags: boldgrid, crio
Requires at least: 4.4
Tested up to: 6.5
Requires PHP: 5.4
Stable tag: 1.10.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Premium features extension for the BoldGrid Crio Theme.

== Description ==

Premium features extension for the BoldGrid Crio Theme.

== Requirements ==

== Installation ==

= Minimum Requirements =
* PHP 5.4 or higher

= Manually =
1. Upload the entire crio-premium folder to the /wp-content/plugins/ directory.
2. Activate the plugin through the Plugins menu in WordPress.

== Changelog ==

= 1.10.5 =
* Bug Fix: Fix warning generated when Inspirations users choose not to display social menus [#181](https://github.com/BoldGrid/boldgrid-inspirations/issues/181)

= 1.10.4 =
* Bug Fix: add continue lazy-loading when already at bottom [#153](https://github.com/BoldGrid/crio-premium/issues/153)
* Update: Update tested to version to 6.4

= 1.10.2 =
* Update: Update tested to version to 6.3

= 1.10.1 =
* Update: Update php code to be PHP 8.2 Compatible by handling all Deprecated warnings.
* Bug Fix: Address issue where some customers where receiving fatal error when opening customizer.
* Update: Update BoldGrid Library to 2.13.11

= 1.10.0 =
* New Feature: Add responsive logo resizing tool [#137](https://github.com/BoldGrid/crio-premium/issues/137)
* Bug Fix: Blog post - Post Meta 'New Lines' does not work [#119](https://github.com/BoldGrid/crio-premium/issues/119)
* Bug Fix: Syntax error due to trailing comma within register_post_type [#142](https://github.com/BoldGrid/crio-premium/issues/142)
* Enhancement: Improve P&PB update notice [#38](https://github.com/BoldGrid/crio-premium/issues/38)

= 1.9.1 =
* Bug Fix: Remove bg-background-color from CPH [#127](https://github.com/BoldGrid/crio-premium/issues/127)

= 1.9.0 =
* New Feature: Customize the text for the post navigation links [#113](https://github.com/BoldGrid/crio-premium/issues/113)
* New Feature: Comment Design Controls [#114](https://github.com/BoldGrid/crio-premium/issues/114)
* New Feature: Lazy Load Blog Posts [#115](https://github.com/BoldGrid/crio-premium/issues/115)
* New Feature: Add control to choose updated or published date for post post meta [#116](https://github.com/BoldGrid/crio-premium/issues/116)

= 1.8.1 =
* Bug Fix: Menu Locations disappear when Page Headers saved as draft [#109](https://github.com/BoldGrid/crio-premium/issues/109)
* Bug Fix: Cannot use a different featured image and page header background override [#97](https://github.com/BoldGrid/crio-premium/issues/97)

= 1.8.0 =
* New Feature: Custom MegaMenus
* Update: Updated Unsplash hotlinks.

= 1.7.2 =
* Bug Fix: Preview on custom headers / footers stopped working it's showing me the last saved one [#94](https://github.com/BoldGrid/crio-premium/issues/94)

= 1.7.1 =
* Bug Fix: Fix featured image overrides not working properly with new opacity changes [#91](https://github.com/BoldGrid/crio-premium/pull/91)

= 1.7.0 =
* New Feature: Use Featured Image as Custom Page Header background [#48](https://github.com/BoldGrid/crio-premium/issues/48)
* Bug Fix: Remove Merge / Include Site Header control [#89](https://github.com/BoldGrid/crio-premium/issues/89)

= 1.6.1 =
* Bug Fix: Resolved get_query_var() fatal error resulting from $wp_query not being defined due to 3rd party plugin conflicts.

= 1.6.0 =
* New Feature: Add Preview to Custom Page Headers & Footers before Updating [#57](https://github.com/BoldGrid/crio-premium/issues/57)

= 1.5.4 =
* Improvement: Minor changes made to accomadate new Crio and PPB features.

= 1.5.3 =
* Bug Fix: Allow CPT's to override page header template [#82](https://github.com/BoldGrid/crio-premium/pull/82)
* Bug Fix: adds admin check for get_current_screen [#84](https://github.com/BoldGrid/crio-premium/pull/84)
* Bug Fix: hide libxml internal errors

= 1.5.2 =
* Bug Fix: update site-title h* in template samples.
* Bug Fix: Fix php notices on Inspirations Page.

= 1.5.1 =
* Bug Fix: Custom Header gets applied to footer [#77](https://github.com/BoldGrid/crio-premium/issues/77)

= 1.5.0 =
* New Feature: Sticky Header Templates using the same builder as the Custom Page Headers[$64](https://github.com/BoldGrid/crio-premium/issues/64)
* New Feature: Footer Templates using the same builder as the Custom Page Headers[$65](https://github.com/BoldGrid/crio-premium/issues/65)
* New Feature: Sticky Header Template and Footer Template selection in the customizer allows users to choose to hide their footer and sticky headers on specified pages / posts.
* Bug Fix: Add Revisions to Custom Page Headers [#49](https://github.com/BoldGrid/crio-premium/issues/49)
* Bug Fix: Add validation when saving a Custom Page Header [#43](https://github.com/BoldGrid/crio-premium/issues/43)
* Bug Fix: Custom Page Headers & dropdown menus [#45](https://github.com/BoldGrid/crio-premium/issues/45)

= 1.4.0 =
* Bug Fix: Custom Page Headers - Blog Page - Background Image override does not work [#46](https://github.com/BoldGrid/crio-premium/issues/46)
* Bug Fix: Sticky Header Logo is squished [#47](https://github.com/BoldGrid/crio-premium/issues/47)
* Bug Fix: Custom Page Headers - individual page background image breaks Easy SEO [#44](https://github.com/BoldGrid/crio-premium/issues/44)

= 1.3.0 =
* New Feature: New Feature: Customizer Edit Buttons v2.

= 1.2.0 =
* New Feature: Sticky Header layout presets.
* Update: Changed Custom Page Header sample layouts to reflect new starter content.
* Bug Fix: Sticky header not refreshing properly in customizer.

= 1.1.1 =
* Update: Changed location of top-level 'Crio' menu to match the newest version ( 2.6.0 ) of Crio.

= 1.1.0 =
* New Feature: Custom Page Headers added.

= 1.0.4 =
* Updated dependencies.

= 1.0.3 =
* Handle the value selected by user for attribution link on frontend properly.

= 1.0.2 =
* Removed broken activation link from notice in certain situations.
* Fixed PHP errors when other BG themes are used and crio license is purchased but crio isn't used.

= 1.0.1 =
* Fixing tabs for regular/sticky header displaying under controls.
* Attribution controls should no longer be missing in the customizer.
* Sticky/fixed header should no longer be selected in customizer when activating plugin by default.

= 1.0.0 =
* Initial release.
