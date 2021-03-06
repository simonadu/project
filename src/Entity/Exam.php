<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExamRepository")
 */
class Exam
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="exams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $teacher;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\field", inversedBy="exams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $field;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\question", inversedBy="exams")
     */
    private $questions;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="examStudents")
     */
    private $student;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\StudentA", mappedBy="exam")
     */
    private $studentAs;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $result;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ExamsForAll", mappedBy="exam")
     */
    private $examsForAlls;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->studentAs = new ArrayCollection();
        $this->examsForAlls = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeacher(): ?user
    {
        return $this->teacher;
    }

    public function setTeacher(?user $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }

    public function getField(): ?field
    {
        return $this->field;
    }

    public function setField(?field $field): self
    {
        $this->field = $field;

        return $this;
    }

    /**
     * @return Collection|question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
        }

        return $this;
    }

    public function removeQuestion(question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStudent(): ?User
    {
        return $this->student;
    }

    public function setStudent(?User $student): self
    {
        $this->student = $student;

        return $this;
    }

    /**
     * @return Collection|StudentA[]
     */
    public function getStudentAs(): Collection
    {
        return $this->studentAs;
    }

    public function addStudentA(StudentA $studentA): self
    {
        if (!$this->studentAs->contains($studentA)) {
            $this->studentAs[] = $studentA;
            $studentA->setExam($this);
        }

        return $this;
    }

    public function removeStudentA(StudentA $studentA): self
    {
        if ($this->studentAs->contains($studentA)) {
            $this->studentAs->removeElement($studentA);
            // set the owning side to null (unless already changed)
            if ($studentA->getExam() === $this) {
                $studentA->setExam(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getResult(): ?float
    {
        return $this->result;
    }

    public function setResult(?float $result): self
    {
        $this->result = $result;

        return $this;
    }

    /**
     * @return Collection|ExamsForAll[]
     */
    public function getExamsForAlls(): Collection
    {
        return $this->examsForAlls;
    }

    public function addExamsForAll(ExamsForAll $examsForAll): self
    {
        if (!$this->examsForAlls->contains($examsForAll)) {
            $this->examsForAlls[] = $examsForAll;
            $examsForAll->setExam($this);
        }

        return $this;
    }

    public function removeExamsForAll(ExamsForAll $examsForAll): self
    {
        if ($this->examsForAlls->contains($examsForAll)) {
            $this->examsForAlls->removeElement($examsForAll);
            // set the owning side to null (unless already changed)
            if ($examsForAll->getExam() === $this) {
                $examsForAll->setExam(null);
            }
        }

        return $this;
    }
}
