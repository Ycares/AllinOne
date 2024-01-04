<?php

namespace App\Security;


use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class PostVoter extends Voter
{
    const CREATE = 'createUser';
    const EDITORDELETE = 'editOrDelete';

    protected function supports(string $attribute, mixed $subject): bool
    {
        if (!in_array($attribute, [self::CREATE, self::EDITORDELETE])) {
            return false;
        }

        if ($attribute == self::EDITORDELETE && !$subject instanceof User) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        return match ($attribute) {
            self::CREATE => true,
            self::EDITORDELETE => $this->canEditOrDelete($subject, $user)
        };
    }

    private function canEditOrDelete(User $subjectUser, User $loggedInUser): bool
    {
        return $subjectUser === $loggedInUser; 
    }
}
