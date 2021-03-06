<?php
namespace bunq\sdk\examples;

use bunq\Context\ApiContext;
use bunq\Model\Generated\User;
use bunq\Model\Generated\UserCompany;

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * The new name of your company.
 */
const NEW_PUBLIC_NICK_NAME = 'Sandbox Company';

/**
 * Other constants.
 */
const MESSAGE_USER_COMPANY_NICKNAME = 'UserCompany nickname: "%s".';
const INDEX_FIRST = 0;

// Restore tha API context
$apiContext = ApiContext::restore(ApiContext::FILENAME_CONFIG_DEFAULT);

// Retrieve the active user.
/** @var User[] $users */
$users = User::listing($apiContext)->getValue();
$user = $users[INDEX_FIRST]->getUserCompany();
$userId = $user->getId();

// Update the publicly visible name of your company.
$userCompanyMap = [
    UserCompany::FIELD_PUBLIC_NICK_NAME => NEW_PUBLIC_NICK_NAME,
];

// Apply the fields in userCompanyMap to the user company.
UserCompany::update($apiContext, $userCompanyMap, $userId);

// You can retrieve the UserCompany again with the id.
/** @var UserCompany $userCompany */
$userCompany = UserCompany::get($apiContext, $userId)->getValue();

vprintf(MESSAGE_USER_COMPANY_NICKNAME, [$userCompany->getPublicNickName()]);
