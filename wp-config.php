<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'marmot_otimaideia' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'marmot_marmotawe' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '!M4rm0t4_W3b_951!' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'g:rk {#e9UI>w|Fqs`OPN0P#p9^f[Shq{|3A1[TksDU-(7>xI-Fdk5x=SIdm?0$G');
define('SECURE_AUTH_KEY',  '#XGnO|*k+cAJBw_ -+|>$vn3>IYWz!WZ}+x`-<<4Ak?#|D2Zh7-*3!|lmjBx9qz^');
define('LOGGED_IN_KEY',    'A/<j-kEGT%,13_Q*]t#|f~L7pI;={9(`83o_&:hGfAMUC-wn,D9oe{4wkkIcu``i');
define('NONCE_KEY',        'I*I=TVM+Z<0xxmv7C~u`&a,fAAZb._AQk#a|&2+os`298+R#JpvY0JMdM(}1kz<y');
define('AUTH_SALT',        '#@S:ao)P]+uEmh7K3l0X_0O<H1)tua<`[+Q&[ Ih[>xB_`uZhMXd`wep%|f%f+T+');
define('SECURE_AUTH_SALT', '1s9]F&T -_iJ%9SLT9#A]r2+btku<;0+E^fAV?~pV#aPfiM@+Un$TafQ%~le1Wkj');
define('LOGGED_IN_SALT',   ',+G|2F5Lk4|P2,8|5TZ+he|(HA Lv%1yZ$I4]kF+W-.U~)0^w(e&S(Pi42$I|hVN');
define('NONCE_SALT',       '^r&|m3ZEak.$]}WgB&LcD7~;oQIi_<!6;&>01@p~VpG$#K#>H-|55uHjit gW%jd');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
