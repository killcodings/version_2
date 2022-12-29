<?php

	class Translate {
		public static array $translates = [
			'en' => [
				'toc_show'            => 'Show',
				'toc_hide'            => 'Hide',
				'post_updated'        => 'Updated',
				'post_author'         => 'Post author',
				'posts'               => 'Posts',
				'comments'            => 'Comments',
				'placeholder_name'    => 'Name',
				'placeholder_email'   => 'Email',
				'placeholder_comment' => 'Comment',
				'comment_button'      => 'Comment'
			],
			'bn' => [
				'toc_show'            => 'দেখান',
				'toc_hide'            => 'লুকান',
				'post_updated'        => 'আপডেট করা হয়েছে',
				'post_author'         => 'পোস্ট লেখক',
				'posts'               => 'পোস্ট',
				'comments'            => 'মন্তব্যসমূহ',
				'placeholder_name'    => 'নাম',
				'placeholder_email'   => 'ইমেইল',
				'placeholder_comment' => 'মন্তব্য করুন',
				'comment_button'      => 'মন্তব্য করুন'
			],
			'pt-br' => [
				'toc_show'            => 'Mostrar',
				'toc_hide'            => 'Esconder',
				'post_updated'        => 'Updated',
				'post_author'         => 'Post author',
				'posts'               => 'Posts',
				'comments'            => 'Comentários',
				'placeholder_name'    => 'Nome',
				'placeholder_email'   => 'Email',
				'placeholder_comment' => 'Comentário',
				'comment_button'      => 'Comentário'
			]
		];

		public static function getLang(): string {
			$site_language_option = get_field('site_language', 'options');
			$current_lang = apply_filters( 'wpml_current_language', null ) ?? $site_language_option;

			if ( $current_lang === 'en' || $current_lang === 'bn' || $current_lang === 'pt-br' ) {
				return $current_lang;
			}

			return 'en';
		}

		public static function get( string $key ): string {

			return  self::$translates[ self::getLang() ][ $key ];
		}
	}
