<?php

namespace common\models;

use Yii;

/**
 * @property CPDB $cP
 */
class USERADBase extends \common\models\db\USERADDB {

    public static $sql_query = "id, username, auth_key, password_hash,is_first_login,password_reset_token, email, status, 
       TO_CHAR(created_at, 'YYYY-MM-DD HH24:MI:SS') created_at,TO_CHAR(updated_at, 'YYYY-MM-DD HH24:MI:SS') updated_at,
       TO_CHAR(last_time_login, 'YYYY-MM-DD HH24:MI:SS') last_time_login,num_login_fail";

}
