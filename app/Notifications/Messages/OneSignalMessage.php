<?php

namespace App\Notifications\Messages;

class OneSignalMessage
{
    public array $headings = [];

    public array $contents = [];

    public array $includedSegments = [];

    public array $externalUserIds = [];

    public function getContents(): array
    {
        return $this->contents;
    }

    public function getHeadings(): array
    {
        return $this->headings;
    }

    public function getIncludedSegments(): array
    {
        return $this->includedSegments;
    }

    public function setContents(array $contents): self
    {
        $this->contents = $contents;

        return $this;
    }

    public function setHeadings(array $headings): self
    {
        $this->headings = $headings;

        return $this;
    }

    public function setIncludedSegments(array $includedSegments): self
    {
        $this->includedSegments = $includedSegments;

        return $this;
    }

    public function getExternalUserIds(): array
    {
        return $this->externalUserIds;
    }

    public function setExternalUserIds(array $externalUserIds): self
    {
        $this->externalUserIds = $externalUserIds;

        return $this;
    }
}
