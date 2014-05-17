UPDATE wp_options SET option_value = replace(option_value, 'http://localhost/ga_crimea_ua', 'http://ga.local') WHERE option_name = 'home' OR option_name = 'siteurl';

UPDATE wp_posts SET guid = replace(guid, 'http://localhost/ga_crimea_ua','http://ga.local');

UPDATE wp_posts SET post_content = replace(post_content, 'http://localhost/ga_crimea_ua', 'http://ga.local');

UPDATE wp_postmeta SET meta_value = replace(meta_value,'http://localhost/ga_crimea_ua','http://ga.local');
