<?php

namespace App\Http;

use App\Data\ContactDTO;
use Core\TemplateInterface;
use Core\DataBinderInterface;
use DateTime;

class ContactHttpHandler extends HttpHandlerAbstract
{
  public function __construct(TemplateInterface $template,
  DataBinderInterface $dataBinder)
  {
    parent::__construct($template, $dataBinder);
  }

  public function add(array $formData = [])
    {
        if (isset($formData['add'])) {
            $this->handleAddProcess($formData);
        } else {
            $this->render("contacts/add");
        }
    }

    public function all()
    {
        $this->render("contacts/all", $this->contactService->getAll());
    }

    public function edit(array $formData = [])
    {
        if (isset($formData['edit'])) {
            $this->handleEditProcess($formData);
        } else {
            $contactDto = $this->getEditDto();
            $this->render("contacts/edit", $contactDto);
        }
    }

    private function handleAddProcess(array $formData)
    {
        try {
            /** @var ContactDTO $contact */
            $contact = $this->dataBinder->bind($formData, ContactDTO::class);
            $this->contactService->create($contact);
            $this->redirect("contacts.php");
        } catch (\Exception $ex) {
            $this->render("contacts/add",
                [$ex->getMessage()]);
        }
    }

    private function handleEditProcess(array $formData)
    {
        try {
            /** @var ContactDTO $contact */
            $contact = $this->dataBinder->bind($formData, ContactDTO::class);
            $this->contactService->edit($contact);
            $this->redirect("contacts.php");
        } catch (\Exception $ex) {
            $contact = $this->getEditDto();

            $this->render("contacts/edit", $contact,
                [$ex->getMessage()]);
        }
    }

    public function delete(array $queryData = [])
    {
        $this->contactService->delete($queryData['id']);
        $this->redirect('contacts.php');
    }

    public function view(array $queryData = [])
    {
        $contact = $this->contactService->getOne($queryData['id']);
        $this->render('contacts/view', $contact);
    }

    private function getEditDto()
    {
        $contact = $this->contactService->getOne($_GET['id']);

        $contactDto = new ContactDTO();
        $contactDto->setName($contact->getName());
        $contactDto->setFamily($contact->getFamily());
        $contactDto->setCity($contact->getCity());
        $contactDto->setAge($contact->getAge());
        $contactDto->setBirthDate($contact->getBirthDate());
        $contactDto->setSex($contact->getSex());
        $contactDto->setEmail($contact->getEmail());
        $contactDto->setNotes($contact->getNotes());
        $contactDto->setAvatar($contact->getAvatar());
        $contactDto->setCreatedAt($contact->getCreatedAt());

        $contactDto->setEditedAt(new \DateTime());

        return $contactDto;
    }
}