<?php

declare(strict_types=1);

namespace Src\Question\Domain;

final class Question
{
    /*public function __construct(
        private ?FeedbackIDVO $id,
        private FeedbackOwnerIDVO $owner_id,
        private FeedbackTagVO $tag,
        private FeedbackTitleVO $title,
        private FeedbackDescriptionVO $description,
        private FeedbackIDStatusVO $id_status,
        private ?FeedbackAssignedToVO $assigned_to,
        private ?FeedbackSolvedDescriptionVO $solved_description,
        private ?FeedbackFixedOnVersionVO $fixed_on_version,
        private FeedbackActiveVO $active,
        private CreatedAtVO $created_at,
        private UpdatedAtVO $updated_at,
        private FeedbackResolvedAtVO $resolved_at,
        private DeletedAtVO $deleted_at
    ) {
    }

    public static function create(
        FeedbackIDVO $id,
        FeedbackOwnerIDVO $owner_id,
        FeedbackTagVO $tag,
        FeedbackTitleVO $title,
        FeedbackDescriptionVO $description,
        FeedbackIDStatusVO $id_status,
        FeedbackAssignedToVO $assigned_to,
        FeedbackSolvedDescriptionVO $solved_description,
        FeedbackFixedOnVersionVO $fixed_on_version,
        FeedbackActiveVO $active
    ): Question {
        $feedback = new self (
            $id,
            $owner_id,
            $tag,
            $title,
            $description,
            $id_status,
            $assigned_to,
            $solved_description,
            $fixed_on_version,
            $active,
            new CreatedAtVO(DateTimeHelper::nowToString()),
            new UpdatedAtVO(null),
            new FeedbackResolvedAtVO(null),
            new DeletedAtVO(null)
        );
        $feedback->addEvent(new FeedbackCreateDomainEvent(
                                null,
                                $feedback,
                                $feedback->getCreatedAt()->value()
                            ));
        return $feedback;
    }

    public function update(
        FeedbackOwnerIDVO $owner_id,
        FeedbackTagVO $tag,
        FeedbackTitleVO $title,
        FeedbackDescriptionVO $description,
        FeedbackIDStatusVO $id_status,
        FeedbackAssignedToVO $assigned_to,
        FeedbackSolvedDescriptionVO $solved_description,
        FeedbackFixedOnVersionVO $fixed_on_version,
        FeedbackActiveVO $active,
    ): void {
        $this->owner_id           = $owner_id;
        $this->tag                = $tag;
        $this->title              = $title;
        $this->description        = $description;
        $this->id_status          = $id_status;
        $this->assigned_to        = $assigned_to;
        $this->solved_description = $solved_description;
        $this->fixed_on_version   = $fixed_on_version;
        $this->active             = $active;
        $this->updated_at         = new UpdatedAtVO(DateTimeHelper::nowToString());

        $this->addEvent(
            new FeedbackUpdateDomainEvent(
                $this->id->value(),
                $this,
                $this->updated_at->value()
            )
        );
    }

    public function updateAssignedTo(FeedbackAssignedToVO $assigned_to)
    {
        $this->assigned_to = $assigned_to;
        $this->updated_at  = new UpdatedAtVO(DateTimeHelper::nowToString());

        $this->addEvent(
            new FeedbackUpdateAssignedToDomainEvent(
                $this->id->value(),
                $assigned_to,
                $this->updated_at,
                $this->updated_at->value()
            )
        );
    }

    public function updateStatus(FeedbackIDStatusVO $id_status)
    {
        $this->id_status  = $id_status;
        $this->updated_at = new UpdatedAtVO(DateTimeHelper::nowToString());

        $this->addEvent(
            new FeedbackUpdateIdStatusDomainEvent(
                $this->id->value(),
                $id_status,
                $this->updated_at,
                $this->updated_at->value()
            )
        );
    }

    public function updateTag(FeedbackTagVO $tag): void
    {
        $this->tag        = $tag;
        $this->updated_at = new UpdatedAtVO(DateTimeHelper::nowToString());

        $this->addEvent(
            new FeedbackUpdateTagDomainEvent(
                $this->id->value(),
                $tag,
                $this->updated_at,
                $this->updated_at->value()
            )
        );
    }

    public function getPrimitives(): array
    {
        return [
            'id'                 => $this->getId()->value(),
            'owner_id'           => $this->getOwnerId()->value(),
            'tag'                => $this->getTag()->value(),
            'title'              => $this->getTitle()->value(),
            'description'        => $this->getDescription()->value(),
            'id_status'          => $this->getIdStatus()->value(),
            'assigned_to'        => $this->getAssignedTo()->value(),
            'solved_description' => $this->getSolvedDescription()->value(),
            'fixed_on_version'   => $this->getFixedOnVersion()->value(),
            'active'             => $this->getActive()->value(),
            'created_at'         => $this->getCreatedAt()->value(),
            'updated_at'         => $this->getUpdatedAt()->value(),
            'resolved_at'        => $this->getResolvedAt()->value(),
            'deleted_at'         => $this->getDeletedAt()->value()
        ];
    }

    public function doesNotShowFeedbacksResolvedMoreThanSevenDaysAgo(): bool
    {
        if ($this->getIdStatus()->value() == FeedbackConstants::STATUS_FEEDBACK_SOLVED && $this->getResolvedAt()->value()) {
            $resolved_at                 = DateTimeHelper::parseToCarbon($this->getResolvedAt()->value());
            $resolved_at_more_seven_days = DateTimeHelper::addDays($resolved_at, FeedbackConstants::FEEDBACK_SEVEN_DAYS);
            if ($resolved_at_more_seven_days < DateTimeHelper::now()) return false;
        }
        return true;
    }

    public function getId(): ?FeedbackIDVO
    {
        return $this->id;
    }

    public function getOwnerId(): FeedbackOwnerIDVO
    {
        return $this->owner_id;
    }

    public function getTag(): FeedbackTagVO
    {
        return $this->tag;
    }

    public function getTitle(): FeedbackTitleVO
    {
        return $this->title;
    }

    public function getDescription(): FeedbackDescriptionVO
    {
        return $this->description;
    }

    public function getIdStatus(): FeedbackIDStatusVO
    {
        return $this->id_status;
    }

    public function getAssignedTo(): FeedbackAssignedToVO|null
    {
        return $this->assigned_to;
    }

    public function getSolvedDescription(): FeedbackSolvedDescriptionVO|null
    {
        return $this->solved_description;
    }

    public function getFixedOnVersion(): FeedbackFixedOnVersionVO|null
    {
        return $this->fixed_on_version;
    }

    public function getActive(): FeedbackActiveVO
    {
        return $this->active;
    }

    public function getCreatedAt(): CreatedAtVO
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): UpdatedAtVO
    {
        return $this->updated_at;
    }

    public function getResolvedAt(): FeedbackResolvedAtVO
    {
        return $this->resolved_at;
    }

    public function getDeletedAt(): DeletedAtVO
    {
        return $this->deleted_at;
    }*/
}
