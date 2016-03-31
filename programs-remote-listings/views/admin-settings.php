
<div class="wrap">
    <h2>Retreat Booking Guru Settings</h2>

    <form action="options.php" method="post"><?php
        settings_fields('rs_settings');
        do_settings_sections(__FILE__);
        $options = get_option('rs_settings'); ?>
        <table class="form-table">
            <tr>
                <th scope="row">Subdomain</th>
                <td>
                    <fieldset>
                        <label><?php $rs_domain = (! empty($options['rs_domain']) && $options['rs_domain'] != '') ? $options['rs_domain'] : ''; ?>
                            https:// <input name="rs_settings[rs_domain]" type="text" id="rs_domain"
                                            value="<?php echo $rs_domain; ?>"/>
                            .secure.retreat.guru<br/>
                        </label> <?php if(empty($rs_domain)) { echo "<span style='color:red;'>Required</span>"; } ?>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">Programs Page</th>
                <td>
                    <p>Choose an existing page on your site to host your programs. This page will list all your programs and be the base location for loading individual programs and categories.</p>
                    <fieldset>
                        <select id="page-programs" name="rs_settings[page][programs]">
                            <option value="">-- Select --</option>
                            <?php
                            $args = array(
                                'sort_order' => 'asc',
                                'sort_column' => 'post_title',
                                'post_type' => 'page',
                                'post_status' => 'publish,private,draft'
                            );
                            $pages = get_pages($args);

                            $selected_page = ! empty( $options['page']['programs'] ) ? $options['page']['programs'] : '';
                            foreach($pages as $page) {
                                echo "<option value='{$page->ID}'" . selected($selected_page, $page->ID, 0) . "> {$page->post_title}</option>";
                            }
                            ?>
                        </select> <?php if(empty($selected_page)) { echo "<span style='color:red;'>Required</span>"; } ?>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">Teachers Page</th>
                <td>
                    <p>Choose an existing page on your site to host your teachers. This page will list your teachers and be the base location for loading individual teachers.</p>
                    <fieldset>
                        <select id="page-teachers" name="rs_settings[page][teachers]">
                            <option value="">-- Select --</option>
                            <?php
                            $args = array(
                                'sort_order' => 'asc',
                                'sort_column' => 'post_title',
                                'post_type' => 'page',
                                'post_status' => 'publish,private'
                            );
                            $pages = get_pages($args);

                            $selected_page = ! empty( $options['page']['teachers'] ) ? $options['page']['teachers'] : '';
                            foreach($pages as $page) {
                                echo "<option value='{$page->ID}'" . selected($selected_page, $page->ID, 0) . "> {$page->post_title}</option>";
                            }
                            ?>
                        </select> <?php if(empty($selected_page)) { echo "<span style='color:red;'>Required</span>"; } ?>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">Google Analytics</th>
                <td>
                    <fieldset>
                        <label><input type="checkbox" name="rs_settings[google_analytics_enable]" value="1" <?php echo (isset($options['google_analytics_enable'])) ? checked($options['google_analytics_enable'], '1') : ''; ?>>
                            Enable Google Analytics tracking (and e-commerce)</label><br>
                        <small>Enabling this will allow you to track users from your site to the Retreat Booking Guru registration form and registration completion page. In order to track how much was spent you need to enable E-commerce Tracking in your Google Analytics admin settings.</small>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">Image thumbnails</th>
                <td>
                    <fieldset>
                        <select name="rs_settings[rs_template][image_size]">
                            <?php $image_size = ! empty( $options['rs_template']['image_size'] ) ? $options['rs_template']['image_size'] : 'medium'; ?>
                            <option value="thumbnail" <?php selected($image_size, 'thumbnail') ?>>Small - Square Cropped</option>
                            <option value="medium" <?php selected($image_size, 'medium') ?>>Medium - Uncropped</option>
                        </select>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">Register Now Button Color</th>
                <td>
                    <fieldset>
                        <label>
                            #<input name="rs_settings[rs_template][register_now]" type="text" id="rs_settings[rs_template][register_now]"
                                    value="<?php echo (isset($options['rs_template']['register_now']) && $options['rs_template']['register_now'] != '') ? $options['rs_template']['register_now'] : ''; ?>"/>
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">Excerpt length</th>
                <td>
                    <fieldset>
                        <p>Set a word limit for teacher and program descriptions on your listings.</p>
                        <label>
                            <input name="rs_settings[rs_template][limit_description]" type="text" id="rs_settings[rs_template][limit_description]" style="width:70px;"
                                    value="<?php echo (isset($options['rs_template']['limit_description']) && $options['rs_template']['limit_description'] != '') ? $options['rs_template']['limit_description'] : '100'; ?>"/> words
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">Hide contact button</th>
                <td>
                    <fieldset>
                        <label>
                            <input name="rs_settings[rs_template][hide_contact_button]" type="checkbox" value="1"
                                <?php if (isset($options['rs_template']['hide_contact_button'])) { echo "checked"; } ?>
                                />
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">Style Adjustments</th>
                <td>
                    <fieldset>
                        Customize or add CSS site styles below<br/>
                        <label>
                                    <textarea name="rs_settings[rs_template][css]" type="text" style="width:700px; height:200px;" id="rs_settings[rs_template][css]"><?php if (isset($options['rs_template']['css'])) echo trim($options['rs_template']['css']); ?>
                                    </textarea><br/>
                    </fieldset>
                </td>
            </tr>
            <tr style="display:none;">
                <th scope="row">Before theme & after</th>
                <td>
                    <fieldset>
                        Wrap template tags around the program listings to fix template bugs<br/>
                        <label>
                                    <textarea name="rs_settings[rs_template][before]" type="text" style="width:700px;height:200px;" id="rs_settings[rs_template][before]"><?php if (isset($options['rs_template']['before'])) echo $options['rs_template']['before']; ?>
                                    </textarea>
                        </label><br/>
                        <label>
                                    <textarea name="rs_settings[rs_template][after]" type="text" style="width:700px;height:100px;" id="rs_settings[rs_template][after]"><?php if (isset($options['rs_template']['after'])) echo $options['rs_template']['after']; ?>
                                    </textarea>
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row"></th>
                <td><input type="submit" style="font-size: 24px;" value="Save"/></td>
            </tr>
        </table>
    </form>
</div>
