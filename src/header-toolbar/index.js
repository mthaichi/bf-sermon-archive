/**
 * WordPress dependencies
 */
import domReady from '@wordpress/dom-ready';
import { render } from '@wordpress/element';
import { subscribe } from '@wordpress/data';
import { getLocaleData } from '@wordpress/i18n';
import { ExternalLink } from '@wordpress/components';

import './style.scss';
/* globals vkpOptions */

const PatternsLink = () => {
	return (
		<>
		<ExternalLink 
			href="https://member.breadfish.jp/dp"
			className="components-button is-secondary"
		>
			教会向けデザインパターン
		</ExternalLink>		
		</>
	);
};

domReady( () => {


	// 言語設定を取得
	// console.log(getLocaleData());
	const lang = getLocaleData()[ '' ].lang;
	if ( lang !== 'ja_JP' ) {
		return;
	}

	const buttonRender = () => {
		const headerToolbar =
			document.querySelector( '.edit-post-header-toolbar' ) ||
			document.querySelector( '.edit-site-header__toolbar' );
		if ( ! headerToolbar ) {
			return;
		}

		const patternsLinkArea = document.createElement( 'div' );
		patternsLinkArea.classList.add( 'bf-patterns-header-toolbar' );

		// .vk-patterns-header-toolbar がまだ存在しなかったら
		if ( ! headerToolbar.querySelector( '.bf-patterns-header-toolbar' ) ) {
			// .vk-patterns-header-toolbar 内にリンク追加
			render( <PatternsLink />, patternsLinkArea );
			// ツールバーの子要素の最後にパターンへのリンクを追加
			headerToolbar.appendChild( patternsLinkArea );
		}
	};

	// 何かしらの変更があったら発火
	// https://developer.wordpress.org/block-editor/reference-guides/packages/packages-data/
	subscribe( () => {
		// console.log('subscribe');
		if ( ! document.querySelector( '.bf-patterns-header-toolbar' ) ) {
			buttonRender();
		}
	} );
} );
