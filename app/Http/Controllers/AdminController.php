<?php

namespace App\Http\Controllers;

use App\Department;
use App\Document;
use App\Repositories\DocumentRepository;

class AdminController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->middleware('auth:admin');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DocumentRepository $repository) {
        if (request('chartData'))
        {
            return $repository->chartData();
        }
        if (request('departments'))
        {
            $departments = Department::orderBy('name')->get();
            foreach ($departments as $dept)
            {
                $dept->noticesCount = count($dept->notices);
                $dept->notificationsCount = count($dept->notifications);
            }
            
            return $departments;
        }
        
        return view('admin.dashboard');
    }
    
    public function show() {
        $documents = Document::latest()->allowed()->get();
        foreach ($documents as $document)
        {
            $document->date = $document->issued_at->format('d M Y');
            $document->departmentName = $document->department->name;
        }
        return view('document.docs', compact('documents'));
    }
    
    public function pending() {
        $documents = Document::latest()->pending()->get();
        
        return view('document.pending', compact('documents'));
    }
    
    public function blocked() {
        $documents = Document::latest()->blocked()->get();
        
        return view('document.blocked', compact('documents'));
    }
    
    public function block(Document $document) {
        $document->blocked = 1;
        $document->save();
        flash('Blocked');
        
        return back();
    }
    
    public function unblock(Document $document) {
        $document->blocked = 0;
        $document->save();
        flash('Un-Blocked');
        
        return back();
    }
    
    public function publish(Document $document) {
        $document->published = 1;
        $document->save();
        flash('Published');
        
        return back();
    }
    
    public function destroy(Document $document) {
        if (file_exists($document->filePath))
            unlink($document->filePath);
        $document->delete();
        flash("Deleted");
        
        return back();
    }
    
    
}
